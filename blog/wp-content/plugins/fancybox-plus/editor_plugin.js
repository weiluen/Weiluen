(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('fancyboxplus');
	
	tinymce.create('tinymce.plugins.fancyboxplusPlugin', {
		init : function(ed, url) {
			var t = this;
			t.editor = ed;
			ed.addCommand('mce_fancyboxplus', t._fancyboxplus, t);
			ed.addButton('fancyboxplus',{
				title : 'fancyboxplus.desc', 
				cmd : 'mce_fancyboxplus',
				image : url + '/img/fancyboxplus-button.png'
			});
		},
		
		getInfo : function() {
			return {
				longname : 'Fancybox Plus for Wordpress',
				author : 'Thorsten Puzich',
				authorurl : 'http://www.puzich.com',
				infourl : 'http://www.puzich.com/fancybox-en/',
				version : '1.0'
			};
		},
		
		// Private methods
		_fancyboxplus : function() { // open a popup window
			fancyboxplus_insert();
			return true;
		}
	});

	// Register plugin
	tinymce.PluginManager.add('fancyboxplus', tinymce.plugins.fancyboxplusPlugin);
})();
