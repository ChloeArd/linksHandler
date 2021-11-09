<main>
    <h1 class="center">Contacter le support technique</h1>
    <form method="post" action="../../assets/php/contact.php" class="flexColumn flexCenter width80 auto">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php
        if (isset($_SESSION['email'])) {
            echo $_SESSION['email'];
        }
        ?>" required>
        <label for="subject">Sujet</label>
        <input type="text" id="subject" name="subject" required>
        <label for="message">Message</label>
        <textarea id="message" name="message"></textarea>
        <input type="submit" name="submit" value="Contacter" class="button">
    </form>
</main>