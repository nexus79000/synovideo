<?php
/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
include_file('desktop', 'modal.syno', 'css', 'synovideo');
?>
<div id='div_searchmovieSynoAlert' style="display: none;"></div>
<div class="tabbed_area" data-type="tvrecording">   
	<ul class="tabs">
		<li><a class="btn tab btn-success" id="tab_tvrecording_added" >{{Derniers ajouts}}</a></li>
		<li><a class="btn tab btn-noselect" id="tab_tvrecording_alpha"  >{{Alphabétique}}</a></li>
	</ul>
	<ul class="tabs_alpha">
		<li><a class="btn tabalpha btn-success" id="tab_all" data-tri_car="all" >{{All}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_1"  data-tri_car="1" >{{1}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_a"  data-tri_car="A" >{{A}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_b"  data-tri_car="B" >{{B}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_c"  data-tri_car="C" >{{C}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_d"  data-tri_car="D" >{{D}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_e"  data-tri_car="E" >{{E}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_f"  data-tri_car="F" >{{F}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_g"  data-tri_car="G" >{{G}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_h"  data-tri_car="H" >{{H}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_i"  data-tri_car="I" >{{I}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_j"  data-tri_car="J" >{{J}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_k"  data-tri_car="K" >{{K}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_l"  data-tri_car="L" >{{L}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_m"  data-tri_car="M" >{{M}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_n"  data-tri_car="N" >{{N}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_o"  data-tri_car="O" >{{O}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_p"  data-tri_car="P" >{{P}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_q"  data-tri_car="Q" >{{Q}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_r"  data-tri_car="R" >{{R}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_s"  data-tri_car="S" >{{S}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_t"  data-tri_car="T" >{{T}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_u"  data-tri_car="U" >{{U}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_v"  data-tri_car="V" >{{V}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_w"  data-tri_car="W" >{{W}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_x"  data-tri_car="X" >{{X}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_y"  data-tri_car="Y" >{{Y}}</a></li>
		<li><a class="btn tabalpha btn-noselect" id="tab_z"  data-tri_car="Z" >{{Z}}</a></li>
	</ul>
	<div class="content" id="content_tvrecording" >
		<?php
		/*	$arrLibrary=config::byKey('SYNO.Library.List','synovideo');
			
			foreach($arrLibrary['tv_record'] as $library){
				log::add('synovideo', 'debug',' Listing de la librairie : '. $library['id'] .' , ' .$library['title'] );

				$searchtvrecording=synovideo::listing('tvrecording','added',null,$library['id']);
				if ($searchtvrecording->total != '0'){
					$i=1;
					foreach ( $searchtvrecording->recording as $tvrecording) {
						foreach ($tvrecording->additional->file as $mfile){
							$idfile=$mfile->id;
						}
						$img_poster=synovideo::getPoster('tvrecording',$tvrecording->id);
						echo '<div class="result resultlist_tvrecording" >';
						echo '	<div class="btn resultposter movieinfo" style="background-image:url('. $img_poster . ');" data-syno_id="' . init('id') . '" data-video_id="'. $tvrecording->id .'" data-file_id="'. $idfile .'">';
						echo '		<a class="btn btn-xs btn-noselect bt_play" data-syno_id="' . init('id') . '" data-file_id="'. $idfile .'" 
									data-file_added="'. $i .'" data-file_alpha="'. str_replace(' ', '_',substr($tvrecording->title,0,10)) .'">
										<i class="fas fa-play">&nbsp&nbsp' . $tvrecording->title . '&nbsp</i>
									</a>';
						echo '	</div>';
						echo '	<div  class="watch-status" >
									<div class="grey-bar">
									<div class="blue-bar" style="width:'. intval($tvrecording->additional->watched_ratio * 100) .'%"></div>
								</div></div>';
						echo '</div>';
						$i++;
					}
				}
			}
		*/?>
	</div>
</div>



<script>
var $divs_tvrecording = $('.tabbed_area[data-type="tvrecording"] div.resultlist_tvrecording');
$('.tabbed_area[data-type="tvrecording"] li.test_tvrecording').text($divs_tvrecording.length);

$('.tabbed_area[data-type="tvrecording"] #tab_tvrecording_added').on('click', function () {
	$('.tabbed_area[data-type="tvrecording"] .tab').removeClass('btn-success').addClass('btn-noselect');
	$('.tabbed_area[data-type="tvrecording"] #tab_tvrecording_added').removeClass('btn-noselect').addClass('btn-success');

	$('.tabbed_area[data-type="tvrecording"] .tabs_alpha').hide();
	
	$('.tabbed_area[data-type="tvrecording"] div.resultlist_tvrecording').each( function( index ) {
		$(this).show();
	});
	
    var numericallyOrderedDivs_tvrecording = $divs_tvrecording.sort(function (a, b) {
        return $(a).find("a").attr('data-file_added') > $(b).find("a").attr('data-file_added');
    });
    $('.tabbed_area[data-type="tvrecording"] #content_tvrecording').html(numericallyOrderedDivs_tvrecording);
});

$('.tabbed_area[data-type="tvrecording"] #tab_tvrecording_alpha').on('click', function () {
	$('.tabbed_area[data-type="tvrecording"] .tab').removeClass('btn-success').addClass('btn-noselect');
	$('.tabbed_area[data-type="tvrecording"] #tab_tvrecording_alpha').removeClass('btn-noselect').addClass('btn-success');
	
	$('.tabbed_area[data-type="tvrecording"] .tabs_alpha').show();
	$('.tabbed_area[data-type="tvrecording"] .tabalpha').removeClass('btn-success').addClass('btn-noselect');
	$('.tabbed_area[data-type="tvrecording"] #tab_all').removeClass('btn-noselect').addClass('btn-success');
	
	$('.tabbed_area[data-type="tvrecording"] div.resultlist_tvrecording').each( function( index ) {
		$(this).show();
	});
	
    var alphabeticallyOrderedDivs_tvrecording = $divs_tvrecording.sort(function (a, b) {
        return $(a).find("a").attr('data-file_alpha') > $(b).find("a").attr('data-file_alpha');
    });
	$('.tabbed_area[data-type="tvrecording"] #content_tvrecording').html(alphabeticallyOrderedDivs_tvrecording);
	$('.tabbed_area[data-type="tvrecording"] li.test_tvrecording').text($divs_tvrecording.length + ' ' + alphabeticallyOrderedDivs_tvrecording.length + ' '+ $('.tabbed_area[data-type="tvrecording"] .tab').length);
});

$('.tabbed_area[data-type="tvrecording"] .content').on('click','.movieinfo',function(){
	var id = $(this).attr('data-syno_id');
	var movieinfo = "tvrecord";
	var video_id = $(this).attr('data-video_id');
	var file_id = $(this).attr('data-file_id');
	$('#md_modal').dialog({title: "Infos lecture"});
	$('#md_modal').load('index.php?v=d&plugin=synovideo&modal=movieinfo.syno&id=' + id + '&movieinfo=' + movieinfo + '&video_id=' + video_id +'&file_id=' + file_id).dialog('open');
});

$('.tabbed_area[data-type="tvrecording"] .tabalpha').on('click', function () {
	$('.tabbed_area[data-type="tvrecording"] .tabalpha').removeClass('btn-success').addClass('btn-noselect');
	$(this).removeClass('btn-noselect').addClass('btn-success');

	var tri_car = $(this).attr('data-tri_car');
	switch(tri_car) {
		case "all":
			$('.tabbed_area[data-type="tvrecording"] div.resultlist_tvrecording').each( function( index ) {
				$(this).show();
			});
			
			break;
		case "1":
			$('.tabbed_area[data-type="tvrecording"] div.resultlist_tvrecording').each( function( index ) {
				$(this).hide();
				if(isNaN($(this).find("a").attr('data-file_alpha').substr(0,1)) == false){
					$(this).show();
				}
			});
			break;
		default:
			$('.tabbed_area[data-type="tvrecording"] div.resultlist_tvrecording').each( function( index ) {
				$(this).hide();	
				if ($(this).find("a").attr('data-file_alpha').substr(0,1).toUpperCase() == tri_car){
					$(this).show();
				}
			});
	}
});

//$('.bt_play').on('click',function(){
$('.tabbed_area[data-type="tvrecording"] .content').on('click','.bt_play',function(){	
	
	var syno_id = $(this).attr('data-syno_id');
	var file_id = $(this).attr('data-file_id');

// A Supprimer ('#div_searchmovieSynoAlert').showAlert({message: syno_id + ' ' + file_id, level: 'danger'});
	
	$.ajax({// fonction permettant de faire de l'ajax
		type: "POST", // methode de transmission des données au fichier php
		url: "plugins/synovideo/core/ajax/synovideo.ajax.php", // url du fichier php
		data: {
			action : "inplay",
			id : syno_id,
			fileid : file_id
		},
		dataType: 'json',
		error: function (request, status, error) {
			handleAjaxError(request, status, error,$('#div_searchmovieSynoAlert'));
		},
		success: function (data) { // si l'appel a bien fonctionné
			if (data.state != 'ok') {
				$('#div_searchmovieSynoAlert').showAlert({message: data.result, level: 'danger'});
				return;
			}
			$('#md_modal2').dialog('close');
		}
	});
});

</script>




