<?php
/**
 * Template Name: Assistance Page
 *
 * @package WordPress
 * @subpackage Clinico
 * @since Clinico 1.0
 */
if (isset($_GET['asearch'])) {
	get_template_part('search-staff');
	return;
}
$cws_stored_meta = get_post_meta( $post->ID, 'cws-mb' );
if (isset( $cws_stored_meta[0]['cws-mb-sb_override'] )) {
	get_template_part('blog');
	return;
}

get_header();

$pid = get_query_var("page_id");
$pid = !empty($pid) ? $pid : get_queried_object_id();
$sb = cws_GetSbClasses($pid);
$sb_block = $sb['sidebar_pos'];
$class_container = 'page-content' . (cws_has_sidebar_pos($sb_block) ? ( 'both' == $sb_block ? ' double-sidebar' : ' single-sidebar' ) : '');
?>
	<div class="<?php echo $class_container; ?>">
		<div class="container">
			<main ng-controller="AssistanceController">
				<div class="col-sm-9">
					<form name="assistanceForm"
						  id="assistanceForm" class="form"
						  ng-submit="sendRequest(assistanceForm.$valid)" novalidate>
						<div class="form-group col-md-12 col-xs-12">
							<div class="col-md-6">
								<label class="col-md-3 col-xs-12">
									Ragione sociale
								</label>
								<div class="col-md-9 col-xs-12">
									<input class="form-control m-bot10" type="text" name="name"
										   ng-model="assistanceRequest.name" placeholder="Nome e Cognome o Ragione Sociale" required/>
								</div>
								<span ng-show="assistanceForm.name.$error.required">Inserisci nome e cognome o ragione sociale.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Regione
							</label>
							<div class="col-md-9 col-xs-12">
								<select class="form-control m-bot10" name="selectedRegion"
									ng-options="region as region.nome for region in regions"
									ng-model="assistanceRequest.selectedRegion" required>
								</select>
								<span ng-show="assistanceForm.selectedRegion.$error.required">Seleziona una regione.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Provincia
							</label>
							<div class="col-md-9 col-xs-12">
								<select class="form-control m-bot10" name="selectedProvince"
									ng-options="province as province.nome for province in provinces"
									ng-model="assistanceRequest.selectedProvince" required>
								</select>
								<span ng-show="assistanceForm.selectedProvince.$error.required">Seleziona una provincia.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Città
							</label>
							<div class="col-md-9 col-xs-12">
								<select class="form-control m-bot10" name="selectedTown"
									ng-options="town as town.nome for town in towns"
									ng-model="assistanceRequest.selectedTown" required>
								</select>
								<span ng-show="assistanceForm.selectedTown.$error.required">Seleziona una città.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Indirizzo
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10" name="address"
									   ng-model="assistanceRequest.address" placeholder="Indirizzo" required/>
								<span ng-show="assistanceForm.address.$error.required">Inserisci un indirizzo.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								CAP
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10"
									   ng-model="assistanceRequest.postCode" name="postCode" placeholder="CAP" required/>
								<span ng-show="assistanceForm.postCode.$error.required">Inserisci un CAP</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Codice Fiscale
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10" name="codFisc"
									   ng-model="assistanceRequest.codFisc" placeholder="Codice Fiscale" required/>
								<span ng-show="assistanceForm.codFisc.$error.required">Inserisci il tuo codice fiscale.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								P.IVA
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10" name="vat"
									   ng-model="assistanceRequest.vat" placeholder="Partita Iva"/>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								E-mail
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="email" class="form-control m-bot10" name="email"
									   ng-model="assistanceRequest.email" placeholder="E-mail" required/>
								<span ng-show="assistanceForm.email.$error.required">Inserisci un'email.</span>
								<span ng-show="assistanceForm.email.$error.email">Inserisci un'email valida.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Cellulare
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10" name="mobile"
									   ng-model="assistanceRequest.mobile" placeholder="Cellulare" required/>
								<span ng-show="assistanceForm.mobile.$error.required">Inserisci un numero di cellulare.</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Tipo Apparecchio
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" name="tool" placeholder="Tipo Apparecchio" ng-model="assistanceRequest.tool" required>
								<span ng-show="assistanceForm.tool.$error.required">Inserisci una tipologia di apparecchio</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Tipo Intervento
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" name="intervention" placeholder="Tipo Intervento" ng-model="assistanceRequest.intervention" required>
								<span ng-show="assistanceForm.intervention.$error.required">Inserisci il tipo di intervento richiesto</span>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Marca
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10" name="brand"
									   ng-model="assistanceRequest.brand" placeholder="Marca" required/>
							</div>
						</div>
						<div class="form-group col-md-6 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Numero di matricola
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="text" class="form-control m-bot10" name="number"
									   ng-model="assistanceRequest.number" placeholder="Matricola" required/>
							</div>
						</div>
						<div class="form-group col-md-12 col-xs-12">
							<label class="col-md-3 col-xs-12">
								Imballo originale
							</label>
							<div class="col-md-9 col-xs-12">
								<input type="checkbox" class="form-control m-bot10 checkbox"
									   ng-model="assistanceRequest.originalPackaging" name="originalPackaging"/>
							</div>
						</div>
						<div class="form-group col-md-12 col-xs-12">
							<label class="col-md-12 col-xs-12">
								Descrizione difetto
							</label>
							<div class="col-md-12 col-xs-12">
									<textarea name="description" class="form-control m-bot10" ng-model="assistanceRequest.description" placeholder="Usa questa casella per descrivere in dettaglio il problema"></textarea>
							</div>
						</div>
						<input type="submit" ng-disabled="assistanceForm.$invalid" style="float:right" name="send_request" value="Invia Richiesta" />
					</form>
				</div>
				<div class="col-sm-3 col-xs-12">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/logo_lat.png"/>
				</div>
			</main>
		</div>
	</div>

<?php get_footer(); ?>