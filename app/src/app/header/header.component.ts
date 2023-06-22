import {Component} from '@angular/core';
import {CartService} from "../services/cart.service";

@Component({
	selector: 'app-header',
	templateUrl: './header.component.html',
	styleUrls: ['./header.component.scss']
})
export class HeaderComponent {

	public cartList: number = 0;

	public constructor(private cartService: CartService) {

		this.cartService.cartSize$.subscribe(number => this.cartList = number.length);

	}

}
