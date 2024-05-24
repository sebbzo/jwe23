<?php include "kopf-frontend.php"; ?>

<main>
    <div class="inner-wrapper">
    <header class="container">
        <h1>Kontakt</h1>
    </header>
    <section class="container">
        <form action="send.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">E-Mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Nachricht:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Nachricht senden</button>
        </form>
    </section>
    </div>
</main>

<?php include "fuss.php"; ?>
