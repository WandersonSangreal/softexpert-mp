import {Injectable} from '@angular/core';
import {Observable, Subject} from "rxjs";

@Injectable({
	providedIn: 'root'
})
export class CartService {

	public lastValue: Array<any> = [];
	public cartSize$: Subject<Array<any>> = new Subject<Array<any>>();

	public constructor() {

		let cartLTV = localStorage.getItem('cart');

		if (cartLTV) {

			this.lastValue = JSON.parse(cartLTV);

			setTimeout(() => {
				this.cartSize$.next(this.lastValue);
			}, 200);

		}

	}

	public setCart(cartList: Array<any>) {

		this.lastValue = cartList;
		this.cartSize$.next(cartList);

		localStorage.setItem('cart', JSON.stringify(this.lastValue));

	}

}
