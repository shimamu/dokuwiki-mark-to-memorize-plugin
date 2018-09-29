module.exports = function(grunt) {
	grunt.initConfig({
		compress : {
			zip : {
				options : {
					archive : 'dist/mark-to-memorize-plugin-1.0.zip'
				},
				files : [{expand:true, src:'**', cwd:'src'}]
			}
		},
	});

	grunt.loadNpmTasks('grunt-contrib-compress');

	grunt.registerTask('default', ['compress']);
};
