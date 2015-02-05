<?php
/*
Plugin Name: Thesaurus
Plugin URI: http://www.benmerrill.com/?thesaurus
Description: This plugin allows you to add a thesaurus lookup to your sidebar, or anywhere else.  Thesaurus service provided by words.bighugelabs.com.
Version: 1.0
Author: Ben Merrill
Author URI: http://www.benmerrill.com
*/

/*
Usage: Just put this into your sidebar file.
	thesaurus_print_lookupform(); //print standard form
		-OR-
	thesaurus_print_lookupform("limit=10"); //limits output to 10 results
*/

//add the thesaurus form element
function thesaurus_print_lookupform($opts="") {
	print '<form name="thesaurus_lookupform" onsubmit="return false;">
		<input type="text" name="word" style="width:130px;"/>
		<input type="submit" value="Go" onclick="thesaurus_lookup(this.form.word,\'lookup_results\',\''.$opts.'\');"/>
		<div id="lookup_results" style="width:150px;"></div>
		</form>';
	return true;
}

add_action('wp_head', 'thesaurus_js_header');

//add thesaurus ajax lookup function
function thesaurus_js_header() {
	wp_print_scripts(array('sack'));
	?>
	<script type="text/javascript">
	//<![CDATA[
	function thesaurus_lookup( lookup_field, results_div, opts ) {
		document.getElementById(results_div).innerHTML = 'Searching...';
		var mysack = new sack("<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/thesaurus/thesaurus_ajax.php");
		mysack.execute = 1;
		mysack.method = 'POST';
		mysack.setVar( "lookup", lookup_field.value );
		mysack.setVar("opts", opts);
		mysack.setVar( "results_div_id", results_div );
		mysack.onError = function() { alert('Ajax error in Thesaurus!')};
		mysack.runAJAX();
		return true;
	}
	//]]>
	</script>
	<?php
} 
?>
