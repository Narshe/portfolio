class Carousel
{
    static bind(selector) {

        $(selector).each(function() {
            new Carousel($(this));
        });
    }

    constructor(container)
    {

        this.currentIndex=0;
        this.container = container.next().find('.carousel');
        this.pictures = this.container.children('.slide');
        this.direction = null;
        this.animationRunning = false;

        this.container.find('#previous').click(this.previous.bind(this));
        this.container.find('#next').click(this.next.bind(this));

        this.init();
    }

    init() {

        this.createBubbles();
        $(this.pictures[this.currentIndex]).show();
        this.updateBubbles();
    }

    createBubbles() {

        for (let i = 0; i<this.pictures.length; i++) {
            let bubble = $('<span class="carousel-bubble"></span>');
            $(this.container.next()).append(bubble);
            bubble.click(this.bubbleClick.bind(this, i));
        }

    }

    bubbleClick(index) {

        if (!this.animationRunning && (index !== this.currentIndex)) {
            this.direction = (index > this.currentIndex) ? 'left' : 'right';
            this.changeSlide(index);
        }

    }

    changeSlide(index)
    {

        this.animationRunning = true;
        index = this.checkIndex(index);

        let that = this;

        $(this.pictures[this.currentIndex]).addClass('slide-out-'+this.direction).one('webkitAnimationEnd oanimationend msAnimationEnd animationend',   function(e) {

            $(this).removeClass('slide-out-'+that.direction);
            $(this).hide();
            that.animationRunning = false;

        });

        $(this.pictures[index]).show().addClass('slide-in-'+this.direction).one('webkitAnimationEnd oanimationend msAnimationEnd animationend',   function(e) {
            $(this).removeClass('slide-in-'+that.direction);
            that.animationRunning = false;
        });

        this.currentIndex = index;
        this.updateBubbles();
    }


    updateBubbles()
    {

        let bubbles = this.container.next().children('.carousel-bubble').each(function() {
            $(this).removeClass('active');
        });


        $(bubbles[this.currentIndex]).addClass('active');

    }

    previous()
    {
        if (!this.animationRunning) {
            this.direction = 'right';
            this.changeSlide(this.checkIndex(this.currentIndex - 1));
        }
    }

    next() {

        if (!this.animationRunning) {
            this.direction = 'left';
            this.changeSlide(this.checkIndex(this.currentIndex + 1));
        }
    }

    checkIndex(index)
    {
        let picturesLength = this.pictures.length-1;

        if (index < 0) {
            index = picturesLength;
        }
        else if (index > picturesLength) {
            index = 0;
        }

        return index;
    }
}

export default Carousel
