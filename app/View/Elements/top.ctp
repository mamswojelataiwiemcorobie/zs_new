<div class="row">
    <div class="col-md-4">
        <h4><i class="icon icon-pushpin"></i>UCZELNIE</h4>
        <?php $topCity = $this->requestAction(array('controller' => 'universities', 
                                            'action' => 'topCity'));
                foreach ($topCity as $city) : ?>
            <a href="/wyszukiwarka/szkoly-wyzsze-1.html?miasto=<?php echo $city['universities']['miasto'];?>"><?php echo $city['universities']['miasto'];?></a> | 
        <?php endforeach; ?>
        <br>
    </div>
    <div class="col-md-4">
        <h4><i class="icon icon-cogs"></i>KIERUNKI</h4>
        <?php $topKierunki = $this->requestAction(array('controller' => 'courses', 
                                            'action' => 'topKierunki'));
        foreach ($topKierunki as $kierunek) : ?>
            <a href="/wyszukiwarka/szkoly-wyzsze-1.html?kierunek=<?php echo $kierunek['nazwa'];?>"><?php echo $kierunek['nazwa'];?></a> | 
        <?php endforeach; ?>
        <br>
    </div>
    <div class="col-md-4">
        <h4><i class="icon icon-leaf"></i>POLICEALNE</h4>
        <div class="bottomspace30">
            <?php $topPolicealne = $this->requestAction(array('controller' => 'universities', 
                                            'action' => 'topPolicealne'));
                foreach ($topPolicealne as $kierunek) : ?>
            <a href="/wyszukiwarka/szkoly-policealne-2.html?miasto=<?php echo $kierunek['u']['miasto'];?>"><?php echo $kierunek['u']['miasto'];?></a> | 
            <?php endforeach; ?>
        </div>
      </div>
    </div>