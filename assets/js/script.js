var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;


function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60); //Rounds down
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
	$(".progressTime.current").text(formatTime(audio.currentTime));
	$(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

	var progress = audio.currentTime / audio.duration * 100; //calculate percentage of time
	$(".playbackBar .progress").css("width", progress + "%"); //output as percentage of width in css for progress bar 
}

function updateVolumeProgressBar(audio) {
    var volume = audio.volume * 100; 
	$(".volumeBar .progress").css("width", volume + "%");
}


class Audio {
	constructor() {
		this.currentlyPlaying;
        this.audio = document.createElement( 'audio' );
        //when song ends make sure to play next song
        this.audio.addEventListener("ended", function() {
            nextSong();
        });

		this.audio.addEventListener("canplay", function () {
			//'this' refers to the object that the event was called on
			var duration = formatTime(this.duration);
            $( ".progressTime.remaining" ).text( duration );
        } );

		this.audio.addEventListener("timeupdate", function () {
			if (this.duration) {
				updateTimeProgressBar(this);
			}
        } );
        
        this.audio.addEventListener("volumechange", function() {
            updateVolumeProgressBar(this);
        });
		this.setTrack = function(track) {
			this.currentlyPlaying = track;
			this.audio.src = track.path;
		};
		this.play = function () {
			this.audio.play();
		};
		this.pause = function () {
			this.audio.pause();
        };
        this.setTime = function(seconds) {
            this.audio.currentTime = seconds;
        }
	}
}
