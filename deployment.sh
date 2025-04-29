#!/bin/bash

# Ensure correct usage
if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <Project_Name> <SSH_Alias>"
    exit 1
fi

# Assign input arguments
PROJECT_NAME=$1
SSH_ALIAS=$2

# Define the builds directory
BUILD_DIR="./ProdBuilds"

# Find the latest version number from existing zip files
LATEST_VERSION=$(ls "$BUILD_DIR" | grep -oP "PB-${PROJECT_NAME}-V\K\d+" | sort -nr | head -n 1)

# Ensure a version exists
if [[ -z "$LATEST_VERSION" ]]; then
    echo "❌ Error: No zip files found for project '$PROJECT_NAME' in $BUILD_DIR!"
    exit 1
fi

# Define local zip file path
ZIP_FILE="${BUILD_DIR}/PB-${PROJECT_NAME}-V${LATEST_VERSION}.zip"

# Define remote directory path
REMOTE_DIR="$HOME/${PROJECT_NAME}/${LATEST_VERSION}/"

# Ensure the zip file exists
if [ ! -f "$ZIP_FILE" ]; then
    echo "❌ Error: Zip file '$ZIP_FILE' not found!"
    exit 1
fi

echo "🚀 Deploying '${PROJECT_NAME}' (Version ${LATEST_VERSION}) to '${SSH_ALIAS}'..."

# Create the project directory on the VPS
ssh "$SSH_ALIAS" "mkdir -p $REMOTE_DIR"
echo "🔐 Securely Tunneled into VPS via SSH '${SSH_ALIAS}'"

# Securely copy the zip file to the VPS
scp "$ZIP_FILE" "$SSH_ALIAS:$REMOTE_DIR"
echo "🧑‍🏭 Files Copied to VPS at '$HOME/${PROJECT_NAME}/${LATEST_VERSION}' at ${SSH_ALIAS}"

# SSH into the VPS, extract the zip, and remove the zip file
ssh "$SSH_ALIAS" <<EOF
    cd $REMOTE_DIR
    unzip -o PB-${PROJECT_NAME}-V${LATEST_VERSION}.zip
    rm -f PB-${PROJECT_NAME}-V${LATEST_VERSION}.zip
    echo "✅ Deployment completed: Files extracted and zip deleted!"
EOF
echo "🧑‍🏭 Files Extracted to '$HOME/${PROJECT_NAME}/${LATEST_VERSION}'"

echo "✅ Deployment successful for '${PROJECT_NAME}' (Version ${LATEST_VERSION}) to '${SSH_ALIAS}'!"
