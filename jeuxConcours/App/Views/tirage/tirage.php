<h1>Tirage au sort</h1>
<table class="tirage">
    <thead>
        <tr>
            <th>nom</th>
            <th>prenom</th>
            <th>date de naissance</th>
            <th>adresse</th>
            <th>ville</th>
            <th>code postal</th>
            <th>email</th>
            <th>telephone</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $result[0]["nom"] ?></td>
            <td><?= $result[0]["prenom"] ?></td>
            <td><?= $result[0]["date_naissance"] ?></td>
            <td><?= $result[0]["adresse"] ?></td>
            <td><?= $result[0]["ville"] ?></td>
            <td><?= $result[0]["code_postal"] ?></td>
            <td><?= $result[0]["email"] ?></td>
            <td><?= $result[0]["telephone"] ?></td>
        </tr>
    </tbody>
</table>
<br>