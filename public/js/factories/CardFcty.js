module.exports = function($http, IMGSRC) {
	
	// CARD PROTOTYPE
	var Card = function(data) {
		for (var key in data) {
			this[key] = data[key];
		}

		this.setContentStrategy(this.source_type);

		this.sourceType = this.source_type;
		this.content = this.contentStrategy.content;
		this.source = this.contentStrategy.source;
		this.sourceDate = this.contentStrategy.sourceDate;

		this.background = this.flipBackground;

		var imgPromise = $http.get(IMGSRC.imgSrc + this.background, {cache: true});

		imgPromise.then(
			// success
			function(data) {
				this.style = {
					backgroundImage: 'url( ' + IMGSRC.imgSrc + this.background + ')',
					backgroundSize: 'cover'
				};
			}.bind(this),
			// failure
			function(data){
				this.background = IMGSRC.defaultFlip;

				this.style = {
					backgroundImage: 'url( ' + IMGSRC.imgSrc + this.background + ')',
					backgroundSize: 'cover'
				};
			}.bind(this)
		);

	};

	Card.prototype = {
		setContentStrategy: function(type) {
			switch (type) {
				case 'text':
					this.contentStrategy = new TextContentStrategy(this);
					break;
				case 'youtube':
					this.contentStrategy = new YoutubeContentStrategy(this);
					break;
			}
		},

		flipCard: function() {
			this.content = this.contentStrategy.flipCard();
			this.source = this.contentStrategy.source;
			this.sourceDate = this.contentStrategy.sourceDate;
			this.background = (this.contentStrategy.flipped) ? this.flopBackground : this.flipBackground;
			var imgPromise = $http.get(IMGSRC.imgSrc + this.background);

			imgPromise.then(
				// success
				function(data) {
					this.style = {
						backgroundImage: 'url( ' + IMGSRC.imgSrc + this.background + ')',
						backgroundSize: 'cover'
					};					
				}.bind(this),
				// failure
				function(data){
					this.background = (this.contentStrategy.flipped) ? IMGSRC.defaultFlop : IMGSRC.defaultFlip;

					this.style = {
						backgroundImage: 'url( ' + IMGSRC.imgSrc + this.background + ')',
						backgroundSize: 'cover'
					};					
				}.bind(this)
			);
		}
	};



	// CONTENT STRATEGIES PROTOTYPES
	/**	
	 * Abstract Class that is extended by TextContentStrategy, YoutubeContentStrategy, etc.
	 * @param {Card} card 
	 */	
	var ContentStrategy = function(card) {
		if(this.constructor == ContentStrategy) {
			throw new Error("Can't instantiate abstract class!");
		}
		
		this.init(card);

		this.content = this.getInitialContent();
	};

	/**
	 * ContentStrategy concrete and abstract methods
	 * @return {[type]} [description]
	 */
	ContentStrategy.prototype = {
		/**
		 * CONCRETE METHODS
		 */
		init: function(card) {
			this.flip = card.flip;
			this.flop = card.flop;
			this.source = this.flipSource = card.flip_source;
			this.flopSource = card.flop_source;

			this.flipped = false;
		},

		/**
		 * ABSTRACT METHODS
		 */
		getInitialContent: function() {
			throw new Error("Abstract Method");
		},

		flipCard: function() {
			throw new Error("Abstract Method");
		}
	};

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
			this.source = (this.flipped) ? this.flipSource : this.flopSource;
			this.sourceDate = (this.flipped) ? this.flipSourceDate : this.flopSourceDate;
			this.flipped = !this.flipped;

			return this.content;
		};

	var YoutubeContentStrategy = function(card) {
		ContentStrategy.apply(this, arguments);
	};
		
	YoutubeContentStrategy.prototype = Object.create(ContentStrategy.prototype);
	YoutubeContentStrategy.prototype.constructor = YoutubeContentStrategy;
	
	YoutubeContentStrategy.prototype
		.getInitialContent = function(card) {
			var content = this.flip;

			return content;
		};

	YoutubeContentStrategy.prototype
		.flipCard =	function() {

			// returns it so it will be an Youtube feed
			this.content = (this.flipped) ? this.flip : this.flop;

			console.log('CardFcty.js: Line 94 -- check of Youtube:');
			console.dir(this.content);

			this.source = (this.flipped) ? this.flipSource : this.flopSource;
			this.sourceDate = (this.flipped) ? this.flipSourceDate : this.flopSourceDate;
			this.flipped = !this.flipped;

			return this.content;
		};

	var create = function(data) {
		return new Card(data);
	};

	// this actually returns the method that will be attached to CardFcty.
	return {
		create: create
	};
};