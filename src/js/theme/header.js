// Add your custom JS here.

class SiteHeader {
    constructor() {

        this._selectors = {
            header: "#wrapper-navbar",
            container: "#main-nav",
            utilityBar: "[js-utility-bar]",
            megaMenuTrigger: "[js-mega-menu-trigger]",
            megaMenuDrawer: "#megaMenuDrawer",
            megaMenu: "[js-mega-menu]"

        }
        this.pause = true
        this.connectedCallback()
    }

    connectedCallback() {
        this.header = document.querySelector(this._selectors.header),
            this.container = document.querySelector(this._selectors.container),
            this.utilityBar = document.querySelector(this._selectors.utilityBar),
            this.megaMenuTriggers = document.querySelectorAll(this._selectors.megaMenuTrigger),
            this.megaMenuDrawer = document.querySelector(this._selectors.megaMenuDrawer),
            // this.megaMenus = this.megaMenuDrawer.querySelector(this._selectors.megaMenu),
            this._setVariables(),
            this._watchWindowResize(), this.megaMenuTriggers.forEach(e => {
                e.addEventListener("click", this._megaMenuTriggerOnClick)
            }
        );
        if (document.body.classList.contains('home')) {
            document.addEventListener("scroll", this._headerOnScorll),
                this.header.addEventListener('mouseover', this._headerOnHover),
                this.header.addEventListener('mouseleave', this._headerOnHover);
        }
        if (document.body.classList.contains('single-product')) {
            document.addEventListener("scroll", this._headerOnScorllProduct);

            document.addEventListener("DOMContentLoaded", function (event) {

                document.querySelectorAll('.scroll-to-top', function (item) {
                    console.log(item)
                    let el = document.querySelector('.top-woo-navbar');
                    item.addEventListener("click", function (e) {
                        console.log(1321)
                        e.stopPropagation();
                        el.style.top = 0
                        window.scrollTo({top: 0, left: 0, behavior: 'smooth'});

                    })
                });
            });
        }


        // this.megaMenuDrawer.addEventListener("close", this._deactivateLastActiveTriggerAndMenu)
    }

    _deactivateLastActiveTriggerAndMenu = () => {
        var e = this.querySelector(this._selectors.megaMenuTrigger + '[data-active="true"]')
            , e = (e && (e.dataset.active = "false"),
            this.megaMenuDrawer.querySelector(this._selectors.megaMenu + '[data-active="true"]'));
        e && (e.dataset.active = "false")
    }
    ;
    _megaMenuTriggerOnClick = e => {
        e.stopPropagation();
        e = e.currentTarget;
        "true" == e.dataset.active ? this.megaMenuDrawer.close() : (this._deactivateLastActiveTriggerAndMenu(),
            e.dataset.active = "true",
            this.megaMenuDrawer.querySelector(`${this._selectors.megaMenu}[data-handle="${e.dataset.handle}"]`).dataset.active = "true",
            this.megaMenuDrawer.open())
    }
    ;
    _headerOnHover = (event) => {
        if (window.innerWidth < 766) {
            return;
        }

        const _self = this
        if (event.type == 'mouseover' && !this.header.classList.contains("bg-light") && _self.pause) {

            setTimeout(function () {
                _self.header.classList.add("bg-light"),
                    _self.container.classList.remove("navbar-dark")
            }, 300)
        }
        if (event.type == 'mouseleave') {
            setTimeout(function () {
                _self.header.classList.remove("bg-light")

                if (1 > window.scrollY) {
                    _self.container.classList.add("navbar-dark")
                }
            }, 300)

        }
        _self.pause = false
        setTimeout(function () {
            _self.pause = true
        }, 500)
    }
    _headerOnScorll = () => {
        if (window.innerWidth < 766) {
            return;
        }
        1 < window.scrollY ? (this.header.classList.add("bg-light"),
            this.header.classList.add("text-black"),
            this.header.classList.remove("text-white"),
            this.container.classList.remove("navbar-dark"),
            this.container.classList.add("bg-light"),
        this.container.classList.contains("mega-menu__hover-trigger") && this.container.classList.remove("desktop:delay-700")) : (this.header.classList.remove("bg-light"),
            this.header.classList.remove("text-black"),
            this.header.classList.add("text-white"),
            this.container.classList.remove("bg-light"),
            this.container.classList.add("navbar-dark"),
        this.container.classList.contains("mega-menu__hover-trigger") && this.container.classList.add("desktop:delay-700"))
    }
    _headerOnScorllProduct = () => {
        if (window.innerWidth < 766) {
            return;
        }

        let offset = document.getElementById('wrapper-navbar').getBoundingClientRect().height;
        let el = document.querySelector('.top-woo-navbar');

        if (offset * 2 < window.scrollY) {

            el.style.top = offset + 'px'
        } else {
            el.style.top = 0
        }
    }

    _watchWindowResize = () => {
        window.addEventListener("resize", this._setVariables)
    }
    ;
    _setVariables = () => {
        this.header.style.setProperty("--header-height", this.header.clientHeight + "px");
        // this.header.style.setProperty("--utility-bar-height", this.utilityBar.clientHeight + "px")
    }
}

export default SiteHeader;