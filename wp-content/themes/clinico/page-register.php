<?php
/**
 * Template Name: Register Page
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
			<main>
				<div class="col-sm-9" ng-controller="UserController">
					<div id="register" ng-show="processedForm == false">
						<h2>Registrati</h2>
						<form name="appbundle_user" id="registerForm" method="post" class="form" ng-submit="register(appbundle_user.$valid)" novalidate>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Ragione sociale</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[name]" id="appbundle_user_name" placeholder="Nome e cognome o Ragione Sociale..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[name].$error.required">Inserisci nome e cognome o ragione sociale.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">P.IVA</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[vat]" id="appbundle_user_vat" placeholder="P.IVA..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[vat].$error.required">Inserisci una partita iva valida.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Codice Fiscale</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[cod_fisc]" id="appbundle_user_cod_fisc" placeholder="Codice fiscale..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[cod_fisc].$error.required">Inserisci un codice fiscale valido.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Telefono</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[telephone]" id="appbundle_user_telephone" placeholder="Telefono..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[telephone].$error.required">Inserisci un recapito telefonico valido.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Email</label>
								<div class="col-md-9 col-xs-12">
									<input type="email" class="form-control m-bot10" name="appbundle_user[email]" id="appbundle_user_email" placeholder="Email..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[email].$error.required">Inserisci una email valida.</span>
									<span ng-show="appbundle_user.appbundle_user[email].$error.email">Inserisci una email valida.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Regione</label>
								<div class="col-md-9 col-xs-12">
									<select class="form-control m-bot10" name="appbundle_user[region]" id="appbundle_user_region" ng-model='currentRegion' ng-change="onRegionChange()" required="required">
										<option ng-repeat="region in regions" value="{{ region.id }}">{{ region.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Provincia</label>
								<div class="col-md-9 col-xs-12">
									<select class="form-control m-bot10" name="appbundle_user[province]" id="appbundle_user_province" ng-model='currentProvince' ng-change="onProvinceChange()" required="required">
										<option ng-repeat="province in provinces" value="{{ province.id }}">{{ province.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Comune</label>
								<div class="col-md-9 col-xs-12">
									<select class="form-control m-bot10" name="appbundle_user[town]" id="appbundle_user_town" ng-model='currentTown' ng-change="onTownChange()" required="required">
										<option ng-repeat="town in towns" value="{{ town.id }}">{{ town.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Indirizzo</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[address]" id="appbundle_user_address" placeholder="Indirizzo..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[address].$error.required">Inserisci un indirizzo valida.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">CAP</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[post_code]" id="appbundle_user_post_code" ng-model="currentPostCode" value="{{ postCode }}" placeholder="CAP..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[post_code].$error.required">Inserisci un CAP valido.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Username</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" class="form-control m-bot10" name="appbundle_user[username]" id="appbundle_user_username" placeholder="Username..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[username].$error.required">Inserisci un username valida.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Password</label>
								<div class="col-md-9 col-xs-12">
									<input type="password" class="form-control m-bot10" name="appbundle_user[password]" id="appbundle_user_password" placeholder="Password..." required="required"/>
									<span ng-show="appbundle_user.appbundle_user[password].$error.required">Inserisci una password valida.</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 col-xs-12">Livello di accesso</label>
								<div class="col-md-9-col-xs-12">
									<select name="appbundle_user[role]" id="appbundle_user_role">
										<option value="ROLE_CUSTOMER">Cliente</option>
										<option value="ROLE_DISTRIBUTOR">Distributore</option>
									</select>
								</div>
							</div>
							<input ng-disabled="appbundle_user.$invalid" type="submit" name="submit" value="Registrati" style="float:right"/>
						</form>
					</div>
					<div class="splashscreen" ng-show="processedForm == true">
						<img src="<?php echo get_template_directory_uri();?>/img/spinner.svg" />
					</div>
				</div>
				<div class="col-sm-3 col-xs-12">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/logo_lat.png"/>
				</div>
			</main>
		</div>
	</div>

<?php get_footer(); ?>