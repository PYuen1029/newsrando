var ContentStrategy = require('./../models/ContentStrategy');

module.exports = function() {
	var TextContentStrategy = function(card) {
		ContentStrategy.apply(this, arguments);
	};

	TextContentStrategy.prototype = Object.create(ContentStrategy.prototype);
	TextContentStrategy.prototype.constructor = TextContentStrategy;

	TextContentStrategy.prototype
		.getInitialContent = function() {
			return this.flip;
		};

	TextContentStrategy.prototype
		.flipCard = function() {
			this.content = (this.flipped) ? this.flip : this.flop;

			this.flipped = !this.flipped;

			return this.content;
		};
	
	return TextContentStrategy;
};