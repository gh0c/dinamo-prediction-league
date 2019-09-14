// https://stackoverflow.com/questions/3446170/escape-string-for-use-in-javascript-regex
function escapeRegEx(str) {
    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

module.exports.escapeRegEx = escapeRegEx;