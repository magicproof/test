// create controller object
var controller = new Controller();

// load IFrame and announce player variable
loadIFrame();
var player;

/**
 * Class Controller purposed to work with Youtube Video iframe API v3
 * @constructor
 */
function Controller() {

    /**
     * Main information about subtitles
     * @protected
     * @type {array}
     */
    this._data = [];

    /**
     * Subtitle start time in seconds
     * @protected
     * @type {number}
     */
    this._time = 0;

    /**
     * Subtitle end time in seconds
     * @protected
     * @type {string}
     */
    this._emotion = '';

    /**
     * Last inserted id of form
     * @protected
     * @type {number}
     */
    this._lastInsertedId = 0;

    /**
     * Video duration in seconds
     * @protected
     * @type {number}
     */
    this._duration = 0;

    /**
     * Time interval for getCurrentTime() function
     * @type {number}
     */
    this._timeInterval = 1000;

    /**
     * Id of setInterval function
     * @type {number}
     */
    this._intervalId = 0;

    /**
     * Fadeout time of submit images
     * @type {number}
     */
    this._fadeSubmitTime = 2000;

    /**
     * Fadeout time of emotions images
     * @type {number}
     */
    this._fadeEmotionTime = 10000;
}

/**
 *  Add listners on page elements
 */
Controller.prototype.addListners = function() {
    var self = this;

    // Add new emotion on click emotion img 
    $('#emotion-menu').on('click', '.menu-img', function() {
        var img = $(this);
        var submit = img.siblings(':first-child');
        if (!submit.hasClass('hidden')) {
            console.log("xxxxx");
            submit.stop(true, true);
            self.submitView(submit);
        }
        self.submitView(submit);
        self._time = Math.round(player.getCurrentTime());
        self._emotion = img.attr('id');
        self.addNewEmotion();
    });
    // Add tutorial button 
    $("#tutorial-dialog").dialog({
        dialogClass: "no-close",
        autoOpen: false,
        buttons: [
            {
                text: "OK",
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]});
    $("#opener").click(function() {
        $("#tutorial-dialog").dialog("open");
    });
};

/**
 * View submit result img for clicked emotion
 * @param {object} submit
 */
Controller.prototype.submitView = function(submit) {
    submit.removeClass('hidden').addClass('fade-img', this._fadeSubmitTime, function() {
        submit.removeClass('fade-img');
        submit.addClass('hidden');
    });
};

/**
 * Start Controller which get json data of emotions from database and put it in this._data array
 */
Controller.prototype.startController = function() {
    this.addListners();
    var self = this;
    $.ajax({
        type: 'POST',
        dataType: "json",
        url: '/main/getEmotions',
        success: function(data) {
            if (data) {
                self._data = data;
            }
        },
        error: function(jqXHR, errCode, exceptionObj) {
            throw new YTControllerException('Cannot load json data by /main/getEmotions', exceptionObj);
        }
    });
};

/**
 * View current users emotion on page in compatible time of playing video
 */
Controller.prototype.startControllerView = function() {
    var self = this;
    this._duration = player.getDuration();
    this._intervalId = setInterval(function() {
        self._timerId = Math.round(player.getCurrentTime());
        for (var i = 0; i < self._data.length; i++) {
            if (self._timerId == self._data[i].time) {
                var existId = $('#' + self._data[i].id).attr('id');
                if (!existId && self._data[i].id) {
                    self.appendNewEmotion(self._data[i].id, self._data[i].name);
                }
            }
        }
    }, self._timeInterval);
};

/**
 * Clear setInterval by id value in property this._intervalId
 */
Controller.prototype.stopController = function() {
    clearInterval(this._intervalId);
};

/**
 * Append new emotion on page and remove it after 10 seconds
 * @param {number} id
 * @param {string} emotion
 */
Controller.prototype.appendNewEmotion = function(id, emotion) {
    var block = $('#block-' + emotion);
    block.append(this.getHtmlTemplate());
    var counter = block.children('.view-img').length;
    this.setHtmlTemplate(id, emotion);
    var text = counter + ':';
    block.children('.counter').text(text);
    $('#' + id).addClass('fade-img', this._fadeEmotionTime, function() {
        block = $(this).parent();
        counter = block.children('.view-img').length;
        counter--;
        text = counter + ':';
        block.children('.counter').text(text);
        $(this).remove();
    });
};

/**
 * Set values of HTML template on page
 * @param {number} id Id of form elements to add
 * @param {string} emotion Name of emotion file
 */
Controller.prototype.setHtmlTemplate = function(id, emotion) {
    $('#emotions-view #template').attr('id', id);
//    console.log($('#emotions-view #template').attr('id', id));
    var img = $('#' + id);
    img.attr('src', '/images/' + emotion + '_80_anim_gif.gif');
};

/**
 * Get HTML template from page
 * @return {string}
 */
Controller.prototype.getHtmlTemplate = function() {
    return document.getElementById('template').outerHTML;
};

/**
 * Add new emotion to data array self._data, send new emotion to database and call this.appendNewEmotion function
 * @param {string} data
 */
Controller.prototype.addNewEmotion = function() {
    var self = this;
    var arrId = [];
    for (var i = 0; i < self._data.length; i++) {
        arrId.push(self._data[i].id);
    }
    self._lastInsertedId = Math.max.apply(null, arrId);
    var id = parseInt(self._lastInsertedId) + 1;
    if (isNaN(id)) {
        id = 1;
    }
    $.ajax({
        type: 'POST',
        data: {time: self._time, name: self._emotion},
        url: '/main/addEmotion',
        success: function() {
            self._data.push({id: id, time: self._time, name: self._emotion});
            var existId = $('#' + self._data[i].id).attr('id');
            if (!existId) {
                self.appendNewEmotion(id, self._emotion);
            }
        },
        error: function(jqXHR, errCode, exceptionObj) {
            throw new YTControllerException('Cannot add emotion', exceptionObj);
        }
    });
};
/**
 * Controller exceptions
 * @param {string} message
 * @param {object} object
 * @constructor
 */
function YTControllerException(message, object) {
    this.message = message;
    this.object = object;
    this.toString = function() {
        return this.message + ' ' + this.object.message;
    };
}

/**
 * Loads the IFrame Player API code asynchronously.
 */
function loadIFrame() {
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

/**
 * This function creates an <iframe> (and YouTube player) after the API code downloads.
 */
function onYouTubeIframeAPIReady() {
    var id = 'w0ffwDYo00Q';
    player = new YT.Player('player', {
        height: '390',
        width: '640',
        videoId: id,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

/**
 * The API will call this function when the video player is ready.
 * @param {object} event
 */
function onPlayerReady(event) {
    event.target.playVideo();
    controller.startController();
}

/**
 * The API calls this function when the player's state changes.
 * The function indicates that when playing a video (state=1),
 * paused (state=2), stopped (state=0) and start or stop controller in addiction of result
 * @param {object} event
 */
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING) {
        controller.startControllerView();
    }
    if (event.data == YT.PlayerState.PAUSED || event.data == YT.PlayerState.ENDED) {
        controller.stopController();
    }
}