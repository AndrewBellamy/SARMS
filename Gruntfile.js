module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        copy: {
            build: {
                expand: true,
                cwd: 'src',
                src: '**',
                dest: 'build/'
            }
        },
        sftp: {
            deakin: {
                files: {
                    "./": ["build/api/**"]
                },
                options: {
                    path: '/home/abellamy/public_html/SARMS',
                    username: '<%= process.env.CD_USR %>',
                    password: '<%= process.env.CD_PWD %>',
                    host: 'ftp.deakin.edu.au',
                    srcBasePath: 'build/',
                    createDirectories: true,
                    showProgress: true
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.registerTask('build', ['copy:build']);

    grunt.loadNpmTasks('grunt-ssh');
    grunt.registerTask('deploy', ['sftp:deakin']);
};