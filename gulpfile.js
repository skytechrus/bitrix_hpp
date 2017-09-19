var gulp = require('gulp');
var util = require('gulp-util');
var git = require('gulp-git');

gulp.task('default', function () {
    //TODO задача для упаковки модуля в архив
});

gulp.task('pub-dev-repo', function () {
    git.push('bitbucket', 'master', function (err) {
        if (err) throw err;
    });
});

gulp.task('pub-prod-repo', function () {
    git.push('github', 'master', function (err) {
        if (err) throw err;
    });
});