import { Controller } from "stimulus";

export default class extends Controller {
    static targets = ["navIcon", "menu"];

    toggleMenu(){
        this.menuTarget.classList.toggle('show');
    }
}
