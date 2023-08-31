<?php
    use App\Utils\Date;
    $date = new Date();
?>
<div class="table">
    <h1>Liste Concours</h1>
    <table class="allConcours">
        <thead>
            <tr>
                <th>nom</th>
                <th>date de début</th>
                <th>date de fin</th>
                <th>edition</th>
                <th>tirage</th>
            </tr>
        </thead>
        <tbody id="test">
            <?php foreach($this->all_operations as $element){?>        
                <tr>                        
                    <td class="tdnom"><?= $element["nom"] ?></td>
                    <td class="tddate_debut"><?= $date->formatDDMMYYYY($element["date_start"]) ?></td>
                    <td class="tddate_fin"><?= $date->formatDDMMYYYY($element["date_end"]) ?></td>
                    <td class="tddate_tirage" hidden><?= $date->formatDDMMYYYY($element["date_tirage"])?></td>
                    <td><button class="uppercase edit" logo_name='<?= $element["logo"] ?>' logo='<?= IMG_URL.$element["logo"]?>' titre='<?= $element["titre"] ?>' key="<?= $element["id"] ?>" description="<?= $element['description'] ?>">editer</button></td>
                    <td><?php if ($element["id_gagnant"]){ ?>effectué <?php }else if($element["date_tirage"] <= $date->today()){?><button key="<?= $element["id"] ?>" class="uppercase tirage">lancer</button><?php } ?></td>                    
                </tr>        
            <?php } ?>
        </tbody>
    </table>
    <button id="add" class="uppercase margeTop succes ajouter">ajouter</button>
</div>
    <div id="modal" id="editV " class="flex editV modal hidden">
        <form id="formOperation" class="flex formOperation" action="/" method="POST" enctype="multipart/form-data">
            <div class="datas">
                <h1 class="marginBot fc3">Données de l'opération</h1>
                <div class="line2 w30 margeAuto marginBot2em c3"></div>
                <input id="key" name="id" type="hidden" class="unselectable" value="">
                <div class="form__group field">                
                    <input id="nom" class="form__field" name="nom" placeholder="nom" type=text value="" required/>
                    <label class="form__label" for="nom">Nom</label>
                </div>
                <div class="form__group field">                
                    <input id="date_debut" name="date_start" class="form__field" id="date_debut" type=date placeholder="date de début" cols="30" rows="10" required></input>
                    <label class="form__label" for="date_debut">Date de début</label>
                </div> 
                <div class="form__group field">                
                    <input id="date_fin" class="form__field" name="date_end" type=date placeholder="date de fin" type=text value="" required/>
                    <label class="form__label" for="date_fin">Date de fin</label>
                </div>
                <div class="form__group field">                
                    <input id="date_tirage" name="date_tirage" class="form__field" id="date_tirage" type=date placeholder="date du tirage" cols="30" rows="10" required>
                    <label class="form__label" for="date_tirage">Date du tirage</label>
                </div>
            </div>
            <div class="edition">
                <h1 class="marginBot fc3">Edition visuel</h1>
                <div class="line2 w30 margeAuto marginBot2em c3"></div>
                <div id="file" class="form__group field file">  
                    <input name="logo" class="form__field" id="logo_input" type=text value="" hidden>              
                    <input name="file" class="form__field" id="file" type=file accept="image/*" placeholder="file" value="upload" hidden>
                    <label class="form__label file_val label_Image" for="file">Image/Logo : click ou glisser déposer pour ajouter ou modifier</label>
                    <img class="editImg" src="" alt=""> 
                </div>
                <div class="form__group field">                
                    <input id="titre" class="form__field" name="titre" placeholder="titre" type=text value=""/>
                    <label class="form__label" for="titre">Titre</label>
                </div>
                <div class="form__group field">                
                    <textarea name="description" class="form__field" id="description" placeholder="titre" cols="30" rows="10"></textarea>
                    <label class="form__label" for="description">Description</label>
                </div>
                <button id="enregOperation" class="uppercase margeTop succes ajouter modalSave">Enregistrer</button>
            </div>
        </form>
        <div id="inscription"></div>
        <div id="closeModal"><i class="fa-solid fa-xmark"></i></div>                   
    </div>