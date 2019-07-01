<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}

if (init('object_id') == '') {
	$object = jeeObject::byId($_SESSION['user']->getOptions('defaultDashboardObject'));
} else {
	$object = jeeObject::byId(init('object_id'));
}
if (!is_object($object)) {
	$object = jeeObject::rootObject();
}
if (!is_object($object)) {
	throw new Exception('{{Aucun objet racine trouvé. Pour en créer un, allez dans Générale -> Objet.<br/> Si vous ne savez pas quoi faire ou que c\'est la premiere fois que vous utilisez Jeedom n\'hésitez pas a consulter cette <a href="http://jeedom.fr/premier_pas.php" target="_blank">page</a>}}');
}
$allObject = jeeObject::all();
$child_object = jeeObject::buildTree($object);
$parentNumber = array();
?>
<div id='div_searchmovieSynoAlert' style="display: none;"></div>
<div class="row row-overflow">
	<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-tachometer"></i> {{Equipement}}</a>
			</li>
			<li role="presentation">
				<a href="#movietab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-list-alt"></i> {{Film}}</a>
			</li>
			<li role="presentation">
				<a href="#showtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-list-alt"></i> {{Séries}}</a>
			</li>
			<li role="presentation">
				<a href="#homevideotab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-list-alt"></i> {{Vidéo perso}}</a>
			</li>
	<!--		<li role="presentation">
				<a href="#tvrecordingtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-list-alt"></i> {{Enregistrements}}</a>
			</li>
			<li role="presentation">
				<a href="#foldertab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-list-alt"></i> {{Dossier}}</a>
			</li>
	-->	</ul>

		<div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
			<div role="tabpanel" class="tab-pane active" id="eqlogictab">	
				<?php
					if ($_SESSION['user']->getOptions('displayObjetByDefault') == 1) {
						echo '<div class="col-lg-2 col-md-3 col-sm-4" id="div_displayObjectList">';
					} else {
						echo '<div class="col-lg-2 col-md-3 col-sm-4" style="display:none;" id="div_displayObjectList">';
					}
				?>
				<div class="bs-sidebar">
					<ul id="ul_object" class="nav nav-list bs-sidenav">
						<li class="nav-header">{{Liste objets}} </li>
						<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
						<?php
							foreach ($allObject as $object_li) {
								$parentNumber[$object_li->getId()] = $object_li->parentNumber();
								$margin = 15 * $parentNumber[$object_li->getId()];
								if ($object_li->getId() == $object->getId()) {
									echo '<li class="cursor li_object active" ><a href="index.php?v=d&p=panel&m=synovideo&object_id=' . $object_li->getId() . '" style="position:relative;left:' . $margin . 'px;">' . $object_li->getHumanName(true) . '</a></li>';
								} else {
									echo '<li class="cursor li_object" ><a href="index.php?v=d&p=panel&m=synovideo&object_id=' . $object_li->getId() . '" style="position:relative;left:' . $margin . 'px;">' . $object_li->getHumanName(true) . '</a></li>';
								}
							}
						?>
					</ul>
				</div>
			</div>
            <?php
            if ($_SESSION['user']->getOptions('displayObjetByDefault') == 1) {
                echo '<div class="col-lg-10 col-md-9 col-sm-8" id="div_displayObject">';
            } else {
                echo '<div class="col-lg-12 col-md-12 col-sm-12" id="div_displayObject">';
            }
            ?>
			<i class='fa fa-picture-o cursor tooltips pull-left' id='bt_displayObject' data-display='<?php echo $_SESSION['user']->getOptions('displayObjetByDefault')?>' title="Afficher/Masquer les objets"></i>
			<br/>
            <?php
            echo '<div class="div_displayEquipement" style="width: 100%;">';
            if (init('object_id') == '') {
                foreach ($allObject as $object) {
                    foreach ($object->getEqLogic(true, false, 'synovideo') as $syno) {
                        echo $syno->toHtml('dview');
                    }
                }
            } else {
                foreach ($object->getEqLogic(true, false, 'synovideo') as $syno) {
                    echo $syno->toHtml('dview');
                }
                foreach ($child_object as $child) {
                    $synos = $child->getEqLogic(true, false, 'synovideo');
                    if (count($synos) > 0) {
                        foreach ($synos as $syno) {
                            echo $synos->toHtml('dview');
                        }
                    }
                }
            }
            echo '</div>';
            ?>
				</div>
			</div>
		
			<div role="tabpanel" class="tab-pane" id="movietab">
				<?php	include_file('desktop', 'movie.syno', 'modal', 'synovideo'); ?>
			</div>
			<div role="tabpanel" class="tab-pane" id="showtab">
				<?php	include_file('desktop', 'tvshow.syno', 'modal', 'synovideo'); ?>
			</div>
			<div role="tabpanel" class="tab-pane" id="homevideotab">
				<?php	include_file('desktop', 'homevideo.syno', 'modal', 'synovideo'); ?>
			</div>
			<div role="tabpanel" class="tab-pane" id="tvrecordingtab">
				<?php	include_file('desktop', 'tvrecording.syno', 'modal', 'synovideo'); ?>
			</div>
			<div role="tabpanel" class="tab-pane" id="foldertab">
				<?php	include_file('desktop', 'folder.syno', 'modal', 'synovideo'); ?>
			</div>
		</div>
	</div>
</div>

<?php include_file('desktop', 'synovideo', 'js', 'synovideo');?>
<?php include_file('desktop', 'dashboard', 'js');?>