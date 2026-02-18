<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de contacto</title>
</head>

<body>
    <div style='width:100%;margin:0;padding:0;background-color:#f5f5f5;font-family:Helvetica,Arial,sans-serif' marginheight='0' marginwidth='0'>
        <div style='display:block;min-height:5px;background-color:#003CA6'></div>
        <center>
            <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0'>
                <tbody>
                    <tr>
                        <td valign='top' align='center' style='border-collapse:collapse;color:#525252'>
                            <table width='85%' cellspacing='0' cellpadding='0' border='0'>
                                <tbody>
                                    <tr>
                                        <td valign='top' height='20' align='center' style='border-collapse:collapse;color:#525252'></td>
                                    </tr>
                                    <tr>
                                        <td valign='top' align='center' style='border-collapse:collapse;color:#525252'>
                                            <table width='100%' border='0'>
                                                <tbody>
                                                    <tr>
                                                        <td height='34' style='border-collapse:collapse;color:#525252'></td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center' style='border-collapse:collapse;color:rgb(82,82,82);font-family:Helvetica,Arial,sans-serif;font-size:30px;font-weight:bold;line-height:120%;text-align:center' colspan='3'>
                                                            Se ha registrado un nuevo contacto
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center' style='border-collapse:collapse;color:#525252;font-size:15px' colspan='3'></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height='38' align='center' style='border-collapse:collapse;color:#525252'></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <table width='100%' style='border-spacing:0px'>
                                                <tbody>
                                                    <tr valign='middle'>
                                                        <td width='100%' valign='middle' align='left' style='border-collapse:collapse;color:#525252;padding:10px;background-color:rgb(255,255,255);border-color:rgb(221,221,221);border-width:1px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-style:solid;font-size:12px;padding:40px!important;vertical-align:middle'>
                                                            <table cellspacing='0' cellpadding='5px' border='0'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style='border-collapse:collapse;color:#525252;padding-right:15px'><b style='color:#888;font-size:10px;text-transform:uppercase'>Nombre</b></td>
                                                                        <td style='border-collapse:collapse;color:#525252'>{{ $nombre ?? '--' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style='border-collapse:collapse;color:#525252;padding-right:15px'><b style='color:#888;font-size:10px;text-transform:uppercase'>Correo electrónico</b></td>
                                                                        <td style='border-collapse:collapse;color:#525252'><a target='_blank' href='mailto:$email'>{{ $email }}</a></td>
                                                                    </tr>
																	<tr>
                                                                        <td style='border-collapse:collapse;color:#525252;padding-right:15px'><b style='color:#888;font-size:10px;text-transform:uppercase'>Empresa</b></td>
                                                                        <td style='border-collapse:collapse;color:#525252'>{{ $empresa ?? '--' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style='border-collapse:collapse;color:#525252;padding-right:15px'><b style='color:#888;font-size:10px;text-transform:uppercase'>Teléfono</b></td>
                                                                        <td style='border-collapse:collapse;color:#525252'>{{ $telefono ?? '--' }}</td>
                                                                    </tr>
																	<tr>
                                                                        <td style='border-collapse:collapse;color:#525252;padding-right:15px'><b style='color:#888;font-size:10px;text-transform:uppercase'>Ciudad</b></td>
                                                                        <td style='border-collapse:collapse;color:#525252'>{{ $ciudad ?? '--' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style='border-collapse:collapse;color:#525252;padding-right:15px'><b style='color:#888;font-size:10px;text-transform:uppercase'>Comentarios</b></td>
                                                                        <td style='border-collapse:collapse;color:#525252'>{{ $comentarios }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign='top' height='33' align='center' style='border-collapse:collapse;color:#525252'></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>
</body>

</html>