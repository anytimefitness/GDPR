<?php

/**
 * This file is used to markup the cookie bar.
 *
 *
 * @link       https://trewknowledge.com
 * @since      1.0.0
 *
 * @package    GDPR
 * @subpackage public/partials
 */
?>

<div class="gdpr gdpr-privacy-bar" style="display:none;">
    <div class="gdpr-wrapper">
        <div class="gdpr-content">
            <p>
                <?= nl2br(wp_kses_post($content)) ?>
            </p>
        </div>
        <div class="gdpr-right">
            <button class="gdpr-preferences hidden" type="button">
                <?= esc_html(translate('Privacy Preferences', 'gdpr')) ?>
            </button>
            <button class="gdpr-agreement btn btn-rounded btn-border btn-white btn-sml btn-submit-form" type="button">
                <?= esc_html($button_text) ?>
            </button>
        </div>
    </div>
</div>
