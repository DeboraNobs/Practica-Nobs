<?php include_once __DIR__ . '../../../header.php'; ?>
    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Usuario</h2>
            
            <form action="/practicas/practicaCartas/index.php?controller=user&action=agregarUsuarios" method="POST" enctype="multipart/form-data">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>

                <label for="foto-perfil">Foto de perfil: (Opcional)</label>
                <input type="file" name="foto-perfil" id="foto-perfil">

                <button type="submit">Añadir Usuario</button>
            </form>

        </div>
        </section>
    </main>
    
<?php include_once __DIR__ . '../../../footer.php'; ?>

