<?php

/** @var yii\web\View $this */

$this->title = 'Pass Clothing - Inventario';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">¡Bienvenido a Pass Clothing!</h1>
        <p class="lead">Gestiona el inventario de tu tienda de ropa de forma rápida y eficiente.</p>
        <p><a class="btn btn-lg btn-success" href="/stock/listar">Accede al Inventario</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Ventas</h2>
                <p>Consulta y administra todas ventas realizadas en la tienda</p>
                <p><a class="btn btn-outline-secondary" href="/venta/listar">Ver Inventario &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Nuevos Productos</h2>
                <p>Añade nuevas prendas al catálogo de Pass Clothing. Mantén tu inventario al día con las últimas tendencias y productos.</p>
                <p><a class="btn btn-outline-secondary" href="/producto/crear">Agregar Producto &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Crea un nuevo usuario</h2>
                <p>Visualiza la tabla de usuarios, puedes crear, actualizar o eliminarlos</p>
                <p><a class="btn btn-outline-secondary" href="/usuario/listar">Ver Usuarios &raquo;</a></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12 text-center">
                <h3>¿Necesitas ayuda?</h3>
                <p>Si tienes alguna pregunta sobre cómo usar la plataforma, contáctanos para recibir asistencia personalizada.</p>
                <p><a class="btn btn-outline-primary" href="/">Contactar Soporte &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
