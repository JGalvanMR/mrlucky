<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de descarga de certificado</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:6px;overflow:hidden;">
                    <tr>
                        <td style="background:#003CA6;padding:20px 30px;">
                            <h1 style="color:#ffffff;font-size:18px;margin:0;">Solicitud de descarga de certificado</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px 30px;">
                            <p style="font-size:14px;color:#333;margin:0 0 16px;">
                                <strong>Certificado solicitado:</strong><br>
                                {{ $nombreCertificado }} (ID: {{ $idCertificado }})
                            </p>

                            <h3 style="font-size:14px;color:#003CA6;border-bottom:1px solid #eee;padding-bottom:6px;">Datos del solicitante</h3>
                            <table role="presentation" width="100%" cellpadding="6" cellspacing="0" style="font-size:14px;color:#333;">
                                <tr><td style="width:160px;"><strong>Nombre</strong></td><td>{{ $datos['nombre'] }}</td></tr>
                                <tr><td><strong>Puesto</strong></td><td>{{ $datos['puesto'] }}</td></tr>
                                <tr><td><strong>Empresa</strong></td><td>{{ $datos['empresa'] }}</td></tr>
                                <tr><td><strong>Correo</strong></td><td>{{ $datos['correo'] }}</td></tr>
                                <tr><td><strong>Teléfono</strong></td><td>{{ $datos['telefono'] }}</td></tr>
                                <tr><td><strong>Contacto en GAB</strong></td><td>{{ $datos['contacto_gab'] }}</td></tr>
                                <tr><td><strong>Uso</strong></td><td>{{ $datos['uso'] }}</td></tr>
                                <tr><td><strong>Fecha</strong></td><td>{{ now()->format('d/m/Y') }}</td></tr>
                                <tr><td><strong>Hora</strong></td><td>{{ now()->format('H:i') }}</td></tr>
                            </table>

                            <p style="font-size:12px;color:#777;margin-top:24px;">
                                Este mensaje fue generado automáticamente desde el sitio web de Mr. Lucky.
                                Por favor revise la solicitud y determine cómo entregar el documento al solicitante.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
