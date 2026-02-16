<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PluxNet - EasyPay</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

         <!-- Scripts -->
        <script>
            function copyToClipboard(name, text) {
                navigator.clipboard.writeText(text).then(() => {
                    alert(`${name} coppied to clipboard`);
                }).catch(err => {
                    alert(`Failed to copy ${name}` + err);
                });
            }
        </script>
    </head>
<body class="bg-gradient-to-br from-pluxnet-navy to-pluxnet-pink min-h-screen text-white antialiased font-sans">
    <nav class="flex w-full px-4 md:px-10 py-6 justify-center items-center">
        <!-- <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/%7B1FBE03EA-24D4-44E8-8F09-B454522EBDC3%7D-zXnnrPKdYwk88hAcoIwN1R00RiCbGT.png" alt="PluxNet Logo" class="h-12"> -->
         <a href="https://pluxnet.co.za">
            <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
         </a>
        <!-- <a href="/register" class="hidden bg-pluxnet-navy text-white text-lg px-6 py-1 rounded-md md:inline-block hover:bg-opacity-90 transition-colors duration-200 ">
            Register
        </a> -->
        <!-- <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['class' => '','href' => route('register'),'wire:navigate' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => '','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('register')),'wire:navigate' => true]); ?>
            <?php echo e(__('Register')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?> -->
    </nav>

    <main class="flex flex-col justify-center items-center mx-auto px-4 py-6">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                <!-- Connect at the Speed of Light -->
                 Connect at the Speed of Light: <br/>Unleash the Power of Fibre Internet!
            </h1>
            <p class="text-xl md:text-2xl mb-8">
                Unleash the Power of Fibre Internet with PluxNet
            </p>
            <!-- <a href="/register" class="bg-pluxnet-coral text-white text-lg px-8 py-3 rounded-full inline-block hover:bg-opacity-90 transition-colors duration-200 mb-12">
                Get Started Now
            </a> -->
        </div>

        <div class="grid md:grid-cols-3 gap-4 mb-12 max-w-5xl">
            <div class="bg-white bg-opacity-10 p-6 rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Lightning-Fast Speeds</h2>
                <p>Experience internet speeds that keep up with your digital lifestyle. Stream, game, and work without interruption.</p>
            </div>
            <div class="bg-white bg-opacity-10 p-6 rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Unmatched Reliability</h2>
                <p>Our state-of-the-art fibre network ensures a stable connection, so you're always connected when it matters most.</p>
            </div>
            <div class="bg-white bg-opacity-10 p-6 rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">No Contracts</h2>
                <p>Enjoy the freedom of no long-term commitments. We're confident you'll love our service without being tied down.</p>
            </div>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-6">Whats my EasyPay Number?</h2>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('dashboard.easypay-generate-card', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1921801897-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <!-- <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-6">Why Choose PluxNet?</h2>
            <ul class="text-lg space-y-4">
                <li>✓ 24/7 Customer Support</li>
                <li>✓ Easy Setup and Installation</li>
                <li>✓ Competitive Pricing</li>
                <li>✓ Unlimited Data Usage</li>
            </ul>
        </div> -->

        <!-- <div class="text-center">
            <p class="text-2xl font-semibold mb-6">Ready to experience the future of internet?</p>
            <a href="/register" class="bg-white text-pluxnet-navy text-lg px-8 py-3 rounded-full inline-block hover:bg-pluxnet-coral hover:text-white transition-colors duration-200">
                Sign Up Today
            </a>
        </div> -->
    </main>

    <footer class="bg-pluxnet-navy bg-opacity-50 mt-12 py-6">
        <div class="flex flex-col md:flex-row gap-4 justify-center items-center px-4 text-center ">
            <p>&copy; <?php echo e(date("Y")); ?> PluxNet. All rights reserved.</p>
            <p class="">
                <a href="#" class="hover:underline">Terms of Service</a> | 
                <a href="#" class="hover:underline">Privacy Policy</a>
            </p>
        </div>
    </footer>
</body>

</html>
<?php /**PATH /home/charles/code/Easypay-PluxNet/resources/views/welcome.blade.php ENDPATH**/ ?>