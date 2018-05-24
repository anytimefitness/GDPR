<div class="wrap gdpr">
	<h1><?php esc_html_e( 'Settings', 'gdpr' ); ?></h1>
	<div class="nav-tab-wrapper">
		<?php foreach ( $tabs as $tab => $value ) : ?>
			<a href="<?php echo '#' . $tab; ?>" class="nav-tab">
				<?php echo esc_html( $value ); ?>
			</a>
		<?php endforeach; ?>
	</div>

	<?php settings_errors(); ?>

	<form action="options.php" method="post" class="gdpr-settings-form">

		<?php settings_fields( 'gdpr' ); ?>

		<div class="gdpr-tab hidden" data-id="general">
			<h2 class="title"><?php esc_html_e( 'Privacy Center', 'gdpr' ); ?></h2>
			<p>
				<?php esc_html_e( 'This section handles the privacy bar and some of the privacy preferences window.', 'gdpr' ) ?><br>
				<strong><?php esc_html_e( 'Important:', 'gdpr' ); ?></strong> <?php esc_html_e( 'If the privacy banner text is not filled out, the privacy banner will not show up. Even if you registered your cookies.', 'gdpr' ) ?></p>
			<table class="form-table" data-id="general">
				<tbody>
					<tr>
						<th scope="row">
							<label for="gdpr_cookie_banner_content"><?php esc_html_e( 'Privacy Banner Text', 'gdpr' ) ?></label>
						</th>
						<td>
							<?php $privacy_bar_content = get_option( 'gdpr_cookie_banner_content', '' ); ?>
							<textarea name="gdpr_cookie_banner_content" id="gdpr_cookie_banner_content" cols="80" rows="6"><?php echo esc_html( $privacy_bar_content ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="gdpr_cookie_privacy_excerpt"><?php esc_html_e( 'Privacy Excerpt', 'gdpr' ) ?></label>
						</th>
						<td>
							<?php $privacy_excerpt = get_option( 'gdpr_cookie_privacy_excerpt', '' ); ?>
							<textarea name="gdpr_cookie_privacy_excerpt" id="gdpr_cookie_privacy_excerpt" cols="80" rows="6"><?php echo esc_html( $privacy_excerpt ); ?></textarea>
							<p class="description"><?php esc_html_e( 'This will appear in the consent section of the privacy preference window.', 'gdpr' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="gdpr-tab hidden" data-id="cookies">
			<h2><?php esc_html_e( 'Cookies', 'gdpr' ) ?></h2>
			<input type="text" id="cookie-tabs" class="regular-text" placeholder="<?php esc_attr_e( 'Category name', 'gdpr' ); ?>">
			<button class="button button-primary add-tab"><?php esc_html_e( 'Add tab', 'gdpr' ); ?></button>
							<div id="tabs">
								<?php $cookie_tabs = get_option( 'gdpr_cookie_popup_content', array() ); ?>
								<?php if ( ! empty( $cookie_tabs ) ) : ?>
									<?php foreach ( $cookie_tabs as $tab_key => $tab ) : ?>
										<div class="postbox" id="cookie-tab-content-<?php echo esc_attr( $tab_key ); ?>">
											<h2 class="hndle"><?php echo esc_html( $tab['name'] ); ?><button class="notice-dismiss" type="button"><span class="screen-reader-text"><?php esc_html_e( 'Remove this tab.', 'gdpr' ); ?></span></button></h2>
											<input type="hidden" name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][name]" value="<?php echo esc_attr( $tab['name'] ); ?>" />
											<div class="inside">
												<table class="form-table">
													<tr>
														<th><label for="always-active-<?php echo esc_attr( $tab_key ); ?>"><?php esc_html_e( 'Always active', 'gdpr' ); ?></label></th>
														<td>
															<label class="gdpr-switch">
																<input type="checkbox" name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][always_active]" <?php checked( esc_attr( $tab['always_active'] ), 1 ); ?> id="always-active-<?php echo esc_attr( $tab_key ); ?>">
																<span class="gdpr-slider round"></span>
															</label>
														</td>
													</tr>
													<tr>
														<th><label for="tab-how-we-use-<?php echo esc_attr( $tab_key ); ?>"><?php esc_html_e( 'How we use', 'gdpr' ); ?></label></th>
														<td><textarea name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][how_we_use]" id="tab-how-we-use-<?php echo esc_attr( $tab_key ); ?>" cols="53" rows="3" required><?php echo esc_html( $tab['how_we_use'] ); ?></textarea></td>
													</tr>
													<tr>
														<th><label for="cookies-used-<?php echo esc_attr( $tab_key ); ?>"><?php esc_html_e( 'Cookies used by the site', 'gdpr' ); ?></label></th>
														<td>
															<textarea cols="53" rows="3" name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][cookies_used]" id="cookies-used-<?php echo esc_attr( $tab_key ); ?>"><?php echo esc_attr( $tab['cookies_used'] ); ?></textarea>
															<br>
															<span class="description"><?php esc_html_e( 'Comma separated list.', 'gdpr' ); ?></span>
														</td>
													</tr>
													<tr>
														<th><label for="hosts-<?php echo esc_attr( $tab_key ); ?>"><?php esc_html_e( 'Third party domains', 'gdpr' ); ?></label></th>
														<td>
															<input type="text" id="hosts-<?php echo esc_attr( $tab_key ); ?>" class="regular-text" placeholder="domain.com" />
															<button class="button button-primary add-host" data-tabid="<?php echo esc_attr( $tab_key ); ?>"><?php esc_html_e( 'Add', 'gdpr' ); ?></button>
															<br>
															<span class="description"><?php esc_html_e( 'Cookies that are set by a third party, like facebook.com.', 'gdpr' ); ?></span>
														</td>
													</tr>
												</table>
												<div class="tab-hosts" data-tabid="<?php echo esc_attr( $tab_key ); ?>">
													<?php if ( isset( $tab['hosts'] ) && $tab['hosts'] ) : ?>
														<?php foreach ( $tab['hosts'] as $host_key => $host ) : ?>
															<div class="postbox">
																<h2 class="hndle"><?php echo esc_attr( $host_key ); ?><button class="notice-dismiss" type="button"><span class="screen-reader-text"><?php esc_html_e( 'Remove this domain.', 'gdpr' ); ?></span></button></h2>
																<input type="hidden" name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][hosts][<?php echo esc_attr( $host_key ); ?>][name]" value="<?php echo esc_attr( $host_key ); ?>" />
																<div class="inside">
																	<table class="form-table">
																		<tr>
																			<th><label for="hosts-cookies-used-<?php echo esc_attr( $host_key ); ?>"><?php esc_html_e( 'Cookies used', 'gdpr' ); ?></label></th>
																			<td>
																				<textarea cols="53" rows="3" name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][hosts][<?php echo esc_attr( $host_key ); ?>][cookies_used]" id="hosts-cookies-used-<?php echo esc_attr( $host_key ); ?>" required><?php echo esc_attr( $host['cookies_used'] ); ?></textarea>
																				<br>
																				<span class="description"><?php esc_html_e( 'Comma separated list.', 'gdpr' ); ?></span>
																			</td>
																		</tr>
																		<tr>
																			<th><label for="hosts-cookies-optout-<?php echo esc_attr( $host_key ); ?>"><?php esc_html_e( 'How to Opt Out', 'gdpr' ); ?></label></th>
																			<td>
																				<input type="text" name="<?php echo esc_attr( 'gdpr_cookie_popup_content' ); ?>[<?php echo esc_attr( $tab_key ); ?>][hosts][<?php echo esc_attr( $host_key ); ?>][optout]" value="<?php echo esc_attr( $host['optout'] ); ?>" id="hosts-cookies-optout-<?php echo esc_attr( $host_key ); ?>" class="regular-text" required />
																				<br>
																				<span class="description"><?php esc_html_e( 'Url with instructions on how to opt out.', 'gdpr' ); ?></span>
																			</td>
																		</tr>
																	</table>
																</div>
															</div>
														<?php endforeach; ?>
													<?php endif; ?>
												</div>
											</div><!-- .inside -->
										</div><!-- .postbox -->
									<?php endforeach ?>
								<?php endif ?>
							</div>
		</div>
		<div class="gdpr-tab hidden" data-id="consents">
			<h2><?php esc_html_e( 'Consents', 'gdpr' ) ?></h2>
			<input type="text" id="type-of-consent" class="regular-text" placeholder="<?php esc_attr_e( 'Type of consent', 'gdpr' ); ?>">
			<button class="button button-primary add-consent"><?php esc_html_e( 'Add consent', 'gdpr' ); ?></button>
			<div id="consent-tabs">
				<?php
				$default_consent_types = array(
					'privacy-policy' => array(
						'name' => translate( 'Privacy Policy', 'gdpr' ),
						'required' => 'on',
						'description' => sprintf( __( 'You read and agreed to our %s.', 'gdpr' ), '<a href="" target="_blank">' . translate( 'Privacy Policy', 'gdpr' ) . '</a>' ),
						'registration' => sprintf( __( 'You read and agreed to our %s.', 'gdpr' ), '<a href="" target="_blank">' . translate( 'Privacy Policy', 'gdpr' ) . '</a>' ),
					)
				);
				$consent_types = get_option( 'gdpr_consent_types', $default_consent_types ); ?>
				<?php if ( ! empty( $consent_types ) ) : ?>
					<?php foreach ( $consent_types as $consent_key => $consent ) : ?>
						<div class="postbox" id="consent-type-content-<?php echo esc_attr( $consent_key ); ?>">
							<h2 class="hndle"><?php echo esc_html( $consent['name'] ); ?> <span>(id: <?php echo esc_html( $consent_key ); ?>)</span><?php echo ( 'privacy-policy' === $consent_key ) ? '' : '<button class="notice-dismiss" type="button"><span class="screen-reader-text">' . esc_html__( 'Unregister this consent.', 'gdpr' ) . '</span></button>'; ?></h2>
							<input type="hidden" name="<?php echo esc_attr( 'gdpr_consent_types' ); ?>[<?php echo esc_attr( $consent_key ); ?>][name]" value="<?php echo esc_attr( $consent['name'] ); ?>" />
							<div class="inside">
								<table class="form-table">
									<tr>
										<th><label for="required-<?php echo esc_attr( $consent_key ); ?>"><?php esc_html_e( 'Required', 'gdpr' ); ?></label></th>
										<td>
											<?php if ( 'privacy-policy' === $consent_key ): ?>
												<span><?php esc_html_e( 'Required', 'gdpr' ) ?></span>
												<input type="hidden" name="<?php echo esc_attr( 'gdpr_consent_types' ); ?>[<?php echo esc_attr( $consent_key ); ?>][required]" id="required-<?php echo esc_attr( $consent_key ); ?>" value="1">
											<?php else: ?>
												<label class="gdpr-switch">
													<input type="checkbox" name="<?php echo esc_attr( 'gdpr_consent_types' ); ?>[<?php echo esc_attr( $consent_key ); ?>][required]" <?php checked( esc_attr( $consent['required'] ), 1 ); ?> id="required-<?php echo esc_attr( $consent_key ); ?>">
													<span class="gdpr-slider round"></span>
												</label>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<th><label for="consent-description-<?php echo esc_attr( $consent_key ); ?>"><?php esc_html_e( 'Consent description', 'gdpr' ); ?></label></th>
										<td><textarea name="<?php echo esc_attr( 'gdpr_consent_types' ); ?>[<?php echo esc_attr( $consent_key ); ?>][description]" id="consent-description-<?php echo esc_attr( $consent_key ); ?>" cols="53" rows="3" required><?php echo esc_html( $consent['description'] ); ?></textarea></td>
									</tr>
									<tr>
										<th><label for="consent-registration-<?php echo esc_attr( $consent_key ); ?>"><?php esc_html_e( 'Registration message', 'gdpr' ); ?></label></th>
										<td><textarea name="<?php echo esc_attr( 'gdpr_consent_types' ); ?>[<?php echo esc_attr( $consent_key ); ?>][registration]" id="consent-registration-<?php echo esc_attr( $consent_key ); ?>" cols="53" rows="3" required><?php echo esc_html( $consent['registration'] ); ?></textarea></td>
									</tr>
								</table>
							</div><!-- .inside -->
						</div><!-- .postbox -->
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
		<div class="gdpr-tab hidden" data-id="export-chanel">
			<h2><?php esc_html_e( 'Data Export Chanel', 'gdpr' ) ?></h2>
			<table class="form-table" data-id="general">
				<tbody>
				<tr>
					<th scope="row">
						<label for="data-export-chanel"><?php esc_html_e( 'Data Export Chanel', 'gdpr' ) ?></label>
					</th>
					<td>
						<?php
						$export_data = get_option('gdpr_export_data');
						?>
						<input name="<?php echo esc_attr( 'gdpr_export_data' ); ?>" type="radio" value="export-data" <?php if ($export_data == 'export-data') { ?> checked <?php } ?> ><?php esc_html_e( 'Data Export with email attachment', 'gdpr' ) ?> <br>
						<input name="<?php echo esc_attr( 'gdpr_export_data' ); ?>" type="radio" value="file-export-data" <?php if ($export_data == 'file-export-data') { ?> checked <?php } ?>><?php esc_html_e( 'Data Export with download link', 'gdpr' ) ?> <br>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<?php
		do_action( 'gdpr_extra_settings' );
		submit_button();
		?>
	</form>

<!-- #poststuff -->
</div>
