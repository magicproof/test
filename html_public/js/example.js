$(document).ready(function() {
    $.ajax({
        type: 'POST',
        data: "id=11&name=POSTER",
        url: '/main/example',
        success: function(data) {
        },
        error: function(jqXHR, errCode, exceptionObj) {
            throw new YTControllerException('Cannot POST', exceptionObj);
        }
    });
    $.ajax({
        type: 'GET',
        data: {id: 23, name: "GETER"},
        url: '/main/example/reg/21',
        success: function(data) {
        },
        error: function(jqXHR, errCode, exceptionObj) {
            throw new YTControllerException('Cannot GET', exceptionObj);
        }
    });

    /**
     * Controller exceptions
     * @param {string} message
     * @param {Object} object
     * @constructor
     */
    function YTControllerException(message, object) {
        this.message = message;
        this.object = object;
        this.toString = function() {
            return this.message + ' ' + this.object.message;
        };
    }
});



