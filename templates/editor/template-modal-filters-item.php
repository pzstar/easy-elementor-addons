<?php
/**
 * Template Library Filter Item
 */
?>
<label class="ht-modal-template-filter-label">
    <input type="radio" value="{{ slug }}" <# if ( '' === slug ) { #> checked<# } #> name="ht-modal-template-filter">
           <span>{{ title.replace('&amp;', '&') }}</span>
</label>