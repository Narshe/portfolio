class Blur
{
    static bind(selector) {

        $(selector).each(function() {
            new Blur($(this));
        });
    }

    constructor(el)
    {
        this.active = false;
        this.el = el;
        this.elToBlur = this.el.find('#card-blur');
        this.elToShow = this.el.find('#blur');
        this.icon = this.el.find('.fa-icon').children();

        this.el.click(this.onClick.bind(this));
    }

    onClick() {

        this.active ? this.removeBlur() : this.addBlur();
    }

    addBlur()
    {
        this.active = true;
        this.icon.removeClass('fa-info-circle').addClass('fa-times-circle');
        this.elToBlur.css('opacity', 0.4);
        this.elToShow.addClass('blur-active');
    }

    removeBlur()
    {
        this.active = false;
        this.icon.addClass('fa-info-circle').removeClass('fa-times-circle');
        this.elToBlur.css('opacity', 1);
        this.elToShow.removeClass('blur-active');
    }

}

export default Blur;
