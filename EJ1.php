<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Covirán</title>
</head>

<body>
    <h1>Ticket de compra</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Precio ud.</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // Precios con IVA del 21 % ya incluido.
            $productos = [
                'Maritoñi' => 2.50,
                'Puleva de fresa' => 1.75,
                'Pipas granaínas' => 0.75,
                'Alhambra roja' => 1.25,
                'Salailla' => 0.50,
            ];

            // Cada cantidad corresponde al producto de la misma posición.
            $cantidadesCompradas = [2, 2, 1, 0, 0];

            $total = 0;

            // Recorremos los productos y obtenemos su cantidad mediante $i.
            $i = 0;

            foreach ($productos as $producto => $precio) {
                $cantidad = $cantidadesCompradas[$i];

                // Mostrar solo los productos comprados.
                if ($cantidad > 0) {
                    $subtotal = $cantidad * $precio;
                    $total += $subtotal;

                    echo "<tr>";
                    echo "<td>$cantidad</td>";
                    echo "<td>$producto</td>";
                    echo "<td>" . number_format($precio, 2, ',', '.') . " €</td>";
                    echo "<td>" . number_format($subtotal, 2, ',', '.') . " €</td>";
                    echo "</tr>";
                }

                $i++;
            }

            // Calcular el IVA incluido en el total.
            $iva = $total * 21 / 121;
            ?>

            <tr>
                <td colspan="3"><strong>TOTAL</strong></td>
                <td>
                    <strong>
                        <?= number_format($total, 2, ',', '.') ?> €
                    </strong>
                </td>
            </tr>

            <tr>
                <td colspan="3"><strong>IVA incluido (21 %)</strong></td>
                <td>
                    <?= number_format($iva, 2, ',', '.') ?> €
                </td>
            </tr>

        </tbody>
    </table>
</body>

</html>