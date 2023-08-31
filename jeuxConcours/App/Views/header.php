<div class="logo tcenter">
    <img src= "<?= $this->personnaliser ? "" : (IMG_DIR.$this->Operation->logo) ?>" alt= "image/logo a personnaliser">
    <div class="tcenter">
        <p class="subTitle"><?=  $this->Operation->titre ?? "titre : a personnaliser" ?></p>
    </div>
</div>
<div class="line2 w30 c3 margeAuto marginBot"></div>
<p class="fc3 tcenter"><?=  $this->Operation->description ?? "description : a personnaliser" ?></p>