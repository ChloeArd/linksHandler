<main>
    <h1 class="center">Ajouter un lien</h1>
    <form method="post" action="" class="flexColumn flexCenter width80 auto">
        <label for="href">L'URL du lien</label>
        <input type="url" id="href" name="href" required>
        <label for="title">Titre de l'image</label>
        <input type="text" id="title" name="title" required>
        <label for="target">Où afficher l'URL liée</label>
        <select id="target" name="target" required>
            <option value="">--Choisi une option--</option>
            <option value="_self">Le contexte de navigation actuel</option>
            <option value="_blank">Un nouvel onglet</option>
            <option value="_parent">Le contexte de navigation parent de celui en cours</option>
            <option value="_top">Le contexte de navigation le plus haut</option>
        </select>
        <label for="name">Nom du lien</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" name="submit" value="Ajouter" class="button">
    </form>
</main>