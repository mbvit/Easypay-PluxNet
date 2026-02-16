# EasyPay PluxNet - Production Deployment Guide

## 🚀 Quick Start

Your Laravel application is now containerized with FrankenPHP for lean, high-performance production deployment.

### Prerequisites
- Docker installed on your server
- Generated `APP_KEY` (see below)
- Configured environment variables

## 📦 What's Included

- **Multi-stage Dockerfile**: Optimized build with separate stages for frontend assets and PHP dependencies
- **FrankenPHP**: Modern, high-performance PHP application server (replaces nginx/PHP-FPM/Caddy stack)
- **SQLite Database**: Simple, file-based database (persisted via Docker volume)
- **Production-ready**: Cached routes/config, optimized autoloader, minified assets

## 🔧 Deployment Steps

### 1. Prepare Environment Variables

Copy the example and configure for production:

```bash
cp .env.example .env
```
**Important**: The `docker-compose.yml` automatically sets the correct database path for Docker containers (`/var/www/database/database.sqlite`). You only need to configure the other variables below.
**Required Configuration:**

```bash
# Generate a unique application key
php artisan key:generate --show

# Copy the generated key to .env
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Splynx API credentials
SPLYNXAPI_HOST_URL=https://your-splynx-instance.com
SPLYNXAPI_KEY=your-api-key
SPLYNXAPI_SECRET=your-api-secret

# EasyPay settings
EASYPAY_RECIEVERID=your-receiver-id
EASYPAY_TOTAL_CHARACTER_LENGTH=12
```

### 2. Build the Docker Image

```bash
docker build -t easypay-pluxnet:latest .
```

**Build Info:**
- Time: ~3-5 minutes (first build)
- Size: ~673MB
- Multi-stage: Yes (minimizes final image)

### 3. Run with Docker

**Simple Run:**
```bash
docker run -d \
  --name easypay-pluxnet \
  --restart unless-stopped \
  -p 8000:8000 \
  --env-file .env \
  -v $(pwd)/database:/var/www/database \
  easypay-pluxnet:latest
```

**With Docker Compose (recommended):**
```bash
docker compose up -d
```

### 4. Verify Deployment

```bash
# Check container status
docker ps

# View logs
docker logs easypay-pluxnet

# Test HTTP response
curl -I http://localhost:8000

# Access application
http://your-server-ip:8000
```

## 🌐 Production Deployment Options

### Option 1: Direct Docker Deployment on VPS

1. **Copy files to server:**
```bash
rsync -avz --exclude 'node_modules' --exclude 'vendor' \
  ./ user@your-server:/var/www/easypay-pluxnet/
```

2. **On the server:**
```bash
cd /var/www/easypay-pluxnet
docker build -t easypay-pluxnet:latest .
docker compose up -d
```

3. **Configure reverse proxy (nginx/Caddy/Nginx Proxy Manager):**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    
    location / {
        proxy_pass http://localhost:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header X-Forwarded-Host $host;
        proxy_set_header X-Forwarded-Port $server_port;
    }
}
```

### Option 3: Nginx Proxy Manager Configuration

**Docker Configuration (.env file):**
```bash
# Set APP_URL to your actual domain
APP_URL=https://easypay.yourdomain.com
```

**Nginx Proxy Manager Settings:**

1. **Proxy Host Configuration:**
   - **Domain Names**: `easypay.yourdomain.com`
   - **Scheme**: `http`
   - **Forward Hostname/IP**: `localhost` (or your server IP if NPM is on different server)
   - **Forward Port**: `8000`
   - **Cache Assets**: ✅ Enabled
   - **Block Common Exploits**: ✅ Enabled
   - **Websockets Support**: ✅ Enabled

2. **Custom Nginx Configuration (Advanced tab):**
   ```nginx
   # Required headers for Laravel behind proxy
   proxy_set_header Host $host;
   proxy_set_header X-Real-IP $remote_addr;
   proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
   proxy_set_header X-Forwarded-Proto $scheme;
   proxy_set_header X-Forwarded-Host $host;
   proxy_set_header X-Forwarded-Port $server_port;
   
   # Increase buffer sizes for large responses
   proxy_buffer_size 128k;
   proxy_buffers 4 256k;
   proxy_busy_buffers_size 256k;
   ```

3. **SSL Configuration:**
   - Use **Let's Encrypt** to generate free SSL certificate
   - Enable **Force SSL** 
   - Enable **HTTP/2 Support**
   - Enable **HSTS Enabled** (recommended)

4. **After Configuration:**
   ```bash
   # Rebuild container to apply APP_URL change
   docker-compose down
   docker-compose build
   docker-compose up -d
   ```

**Troubleshooting NPM:**
- If assets (CSS/JS) don't load, verify `APP_URL` matches your domain exactly
- Check browser console for mixed content warnings (http vs https)
- Ensure NPM is forwarding headers correctly (see custom config above)
- Clear Laravel cache: `docker exec easypay-pluxnet php artisan optimize:clear`

### Option 2: Save/Load Docker Image

**On your local machine:**
```bash
# Build and save
docker build -t easypay-pluxnet:latest .
docker save easypay-pluxnet:latest | gzip > easypay-pluxnet.tar.gz

# Transfer to server
scp easypay-pluxnet.tar.gz user@your-server:/tmp/
```

**On the server:**
```bash
# Load image
docker load < /tmp/easypay-pluxnet.tar.gz

# Run
docker run -d \
  --name easypay-pluxnet \
  --restart unless-stopped \
  -p 8000:8000 \
  --env-file .env \
  -v /var/www/easypay-pluxnet/database:/var/www/database \
  easypay-pluxnet:latest
```

## 🔐 Security Considerations

1. **Environment Variables**: Never commit `.env` to version control
2. **APP_KEY**: Generate a unique key for each environment
3. **Database Permissions**: SQLite database volume is mounted - ensure host directory permissions are secure
4. **Firewall**: Only expose port 8000 to your reverse proxy, not publicly
5. **HTTPS**: Always use SSL/TLS in production (configure reverse proxy)

## 📊 Monitoring & Logs

```bash
# View real-time logs
docker logs -f easypay-pluxnet

# Check container health
docker ps --filter "name=easypay-pluxnet"

# View Laravel logs inside container
docker exec easypay-pluxnet tail -f /var/www/storage/logs/laravel.log

# Database location (on host)
./database/database.sqlite
```

## 🔄 Updates & Maintenance

### Update Application Code

```bash
# Pull latest code
git pull origin main

# Rebuild image
docker build -t easypay-pluxnet:latest .

# Stop old container
docker stop easypay-pluxnet
docker rm easypay-pluxnet

# Start new container
docker compose up -d
```

### Database Backup

```bash
# Backup SQLite database
docker exec easypay-pluxnet sqlite3 /var/www/database/database.sqlite ".backup '/var/www/database/backup-$(date +%Y%m%d).sqlite'"

# Or from host
cp ./database/database.sqlite ./database/backup-$(date +%Y%m%d).sqlite
```

### Clear Caches (if needed)

```bash
docker exec easypay-pluxnet php artisan optimize:clear
docker restart easypay-pluxnet
```

## 🐛 Troubleshooting

### "Database file does not exist" error
```bash
# This error occurs when .env has the wrong database path
# Fix: docker-compose.yml automatically sets DB_DATABASE=/var/www/database/database.sqlite
# Just run: docker compose down && docker compose up -d

# Verify database directory exists and has correct permissions:
chmod 775 ./database
touch ./database/database.sqlite
chmod 664 ./database/database.sqlite
```

### Container won't start
```bash
# Check logs
docker logs easypay-pluxnet

# Common issues:
# - APP_KEY not set in .env
# - Database directory permissions
# - Port 8000 already in use
```

### Database errors
```bash
# Ensure database directory is writable
chmod 775 ./database
chmod 664 ./database/database.sqlite

# Restart container
docker restart easypay-pluxnet
```

### 500 Error on homepage
```bash
# Check Laravel logs
docker exec easypay-pluxnet tail -50 /var/www/storage/logs/laravel.log

# Clear caches
docker exec easypay-pluxnet php artisan optimize:clear
```

## 📝 Configuration Files

- **[Dockerfile](Dockerfile)**: Multi-stage build configuration
- **[docker-compose.yml](docker-compose.yml)**: Orchestration file
- **[docker-entrypoint.sh](docker-entrypoint.sh)**: Startup script (migrations, cache warming)
- **[.dockerignore](.dockerignore)**: Excluded files from build context
- **[.env.example](.env.example)**: Environment template

## 🎯 Performance Tips

1. **Image Size**: Current ~673MB is optimal for a full Laravel + FrankenPHP stack
2. **Startup Time**: ~5-8 seconds (migrations + cache warming)
3. **Memory**: FrankenPHP typically uses 50-150MB RAM
4. **Database**: SQLite is perfect for small-medium traffic; consider PostgreSQL for high traffic

## ✅ Production Checklist

- [ ] `.env` configured with production values
- [ ] `APP_KEY` generated and set
- [ ] `APP_DEBUG=false`
- [ ] Splynx API credentials configured
- [ ] Database volume configured for persistence
- [ ] Reverse proxy/load balancer configured
- [ ] SSL/TLS certificates installed
- [ ] Firewall rules configured
- [ ] Backup strategy in place
- [ ] Monitoring/logging configured

---

**Need Help?**
- Docker Docs: https://docs.docker.com/
- FrankenPHP: https://frankenphp.dev/
- Laravel Deployment: https://laravel.com/docs/deployment
