var ContentStrategy = require('./../models/ContentStrategy');

module.exports = function() {
	var AudioContentStrategy = function(card) {
		ContentStrategy.apply(this, arguments);
	};
		
	AudioContentStrategy.prototype = Object.create(ContentStrategy.prototype);
	AudioContentStrategy.prototype.constructor = AudioContentStrategy;
	
	AudioContentStrategy.prototype
		.getInitialContent = function(card) {
			return 'Audio: ' + this.flip;
		};

	AudioContentStrategy.prototype
		.flipCard =	function() {
			this.content = (this.flipped) ? 'Audio ' + this.flip : 'Audio ' + this.flop;

			this.flipped = !this.flipped;

			return this.content;
		};

	return AudioContentStrategy;
};