<form action="<?= $this->Router->nameConcours?>" method="POST">
        <div id="formulaire" class="formulaire c2">
                <h1 class="uppercase">votre inscription</h1>
                <div class="line2 w30 margeAuto marginBot c1"></div>
                <p class="f2 faded italic fsize80 marginNone marginLeft marginBot03 tleft">*<span class="capitalize">champs</span> obligatoires</p>

            <!-- nom -->
            <p 
                class="error" 
                <?= isset($this->erreur["nom"]) ? "" : "hidden" ?>
            ><?= $this->erreur["nom"] ?? ""?></p>
            <div class="flex input">               
                <label class="flex capitalize" for="nom">nom* : </label>
                <input 
                    type="text" 
                    name="nom" 
                    pattern="<?= PATTERN["nom"]["pattern"]?>" 
                    title="ecrivez un nom valide"  
                    required 
                    value="<?=  $this->post["nom"] ?? "" ?>"
                >
            </div>

            <!-- prenom -->
            <p 
                class="error" 
                <?= isset($this->erreur["prenom"]) ? "" : "hidden" ?>
            ><?= $this->erreur["prenom"] ?? ""?></p>
            <div class="flex input">
            <label class="flex capitalize" for="nom">prénom* : </label>
          
            <input
                type="text"
                name="prenom" 
                pattern="<?= PATTERN["prenom"]["pattern"]?>" 
                title="ecrivez un prenom valide" 
                required 
                value="<?= $this->post["prenom"] ?? "" ?>" 
            >    
            </div>

            <!-- email -->
            <p 
                id="emailLabel" 
                class="error" 
                <?= isset($this->erreur["email"]) ? "" : "hidden" ?>
            ><?= $this->erreur["email"] ?? ERROR["email"]["inscrit"]?></p> 
            <div class="flex input">
            <label class="flex capitalize" for="nom">email* : </label>
            
            <input 
                type="text" 
                name="email" 
                pattern="<?= PATTERN["email"]["pattern"]?>"  
                title="adresse mail non valide" 
                required 
                value="<?= $this->post["email"] ?? "" ?>" 
            > 
            </div>

            <!-- date_naissance -->
            <p 
                class="error" 
                <?= isset($this->erreur["date_naissance"]) ? "" : "hidden" ?>
            ><?= $this->erreur["date_naissance"] ?? "" ?></p>
            <div class="flex input">
            <label class="flex" for="nom"><span class="capitalize">date</span> de naissance : </label>
           
            <input 
                type="date" 
                class="date" 
                name="date_naissance" 
                pattern="<?= PATTERN["date_naissance"]["pattern"]?>" 
                title="format date non valide" 
                value="<?= $this->post["date_naissance"] ?? "" ?>"
            >
            </div>

            <!-- phone -->
            <p 
                class="error" 
                <?= isset($this->erreur["telephone"]) ? "" : "hidden" ?>
            ><?= $this->erreur["telephone"] ?? "" ?></p>
            <div class="flex input">
            <label class="flex capitalize" for="nom">telephone : </label>
           
            <input 
                type="tel" 
                pattern="<?= PATTERN["telephone"]["pattern"]?>" 
                title="le numéro de telephone est composé de 10 chiffres avec 0 pour le premier" 
                name="telephone" 
                value="<?= $this->post["telephone"] ?? "" ?>"
            >
            </div>

            <!-- adresse -->
            <div class="flex input">
            <label class="flex capitalize" for="nom">adresse : </label>
            <input 
                type="text" 
                name="adresse" 
                value="<?= $this->post["adresse"] ?? "" ?>" 
            >
            </div>
            <div id="listeAdresse"></div>
            

            <!-- ville -->
            <div class="flex input">
            <label class="flex capitalize" for="nom">ville : </label>
            <input 
                type="text" 
                name="ville" 
                value=<?= $this->post["ville"] ??  "" ?>
            >
            </div>

            <!-- code_postal -->
            <p 
                class="error" 
                <?= isset($this->erreur["code_postal"]) ? "" : "hidden" ?>
            ><?= $this->erreur["code_postal"] ?? "" ?></p>
            <div class="flex input">
            <label class="flex" for="nom"><span class="capitalize">code</span> postal* : </label>
        
            <input 
                type="text" 
                name="code_postal" 
                pattern="<?= PATTERN["code_postal"]["pattern"]?>" 
                title="le code postal doit être composé de 5 chiffres" 
                required 
                value="<?= $this->post["code_postal"] ?? "" ?>" 
            >
            </div>
            
     
            
            <!-- button -->
            <div class="tcenter">
                <button id="valider" class="submit w70" type="button"><span class="capitalize">je</span> participe ></button>
            </div>
            <p class="fc1 f2 tcenter fsize80 faded italic underline marginTop"><span class="capitalize">règlement</span> du jeu</p>

        </div>
        
        <?php if (!$this->personnaliser){ ?>
        <div class="confirmation">
            <input id="modifier" class="submit" type="button" value="modifier">
            <input class="submit" type="submit" value="confirmer">
        <div>
        <?php } ?>
        
        
</form>    