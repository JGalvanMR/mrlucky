<?php
// aplicar-parche.php
// Coloca este archivo en la raíz de tu proyecto Laravel.
// Asegúrate de que el archivo con el parche se llame "mrlucky.patch" y esté en la misma carpeta.
// Ejecuta: php aplicar-parche.php

$patchFile = __DIR__ . '/mrlucky.patch';

// 1. Verificar que existe el archivo del parche
if (!file_exists($patchFile)) {
    die("❌ Error: No se encuentra el archivo 'mrlucky.patch' en la raíz del proyecto.\n");
}

echo "📦 Parche encontrado. Aplicando cambios...\n";

// 2. Intentar aplicar con git apply (recomendado, maneja renombres y modos)
exec('git apply --whitespace=fix --ignore-whitespace ' . escapeshellarg($patchFile) . ' 2>&1', $output, $code);

if ($code === 0) {
    echo "✅ Parche aplicado EXITOSAMENTE con 'git apply'.\n";
    echo "🚀 Ahora ejecuta: php artisan migrate\n";
    echo "🧹 Luego: php artisan config:clear && php artisan cache:clear && php artisan view:clear\n";
    exit(0);
}

echo "⚠️  'git apply' falló (código $code). Intentando con 'patch' (método alternativo)...\n";

// 3. Fallback con el comando "patch" (más tolerante a diferencias de espacios)
exec('patch -p1 < ' . escapeshellarg($patchFile) . ' 2>&1', $output2, $code2);

if ($code2 === 0) {
    echo "✅ Parche aplicado EXITOSAMENTE con 'patch'.\n";
    echo "🚀 Ahora ejecuta: php artisan migrate\n";
    echo "🧹 Luego: php artisan config:clear && php artisan cache:clear && php artisan view:clear\n";
    exit(0);
}

// 4. Si todo falla, mostramos los errores para depurar
echo "❌ AMBOS MÉTODOS FALLARON. Revisa los mensajes:\n";
echo "--- Salida de git apply ---\n";
echo implode("\n", $output) . "\n";
echo "--- Salida de patch ---\n";
echo implode("\n", $output2) . "\n";

exit(1);