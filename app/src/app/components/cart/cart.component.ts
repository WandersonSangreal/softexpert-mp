import {Component, OnInit} from '@angular/core';
import {CartService} from "../../services/cart.service";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";

@Component({
	selector: 'app-cart',
	templateUrl: './cart.component.html',
	styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {

	public items: Array<any> = [];

	public constructor(private http: HttpClient, private cartService: CartService) {

		this.items = this.cartService.lastValue;

	}

	public ngOnInit(): void {

		this.http.get<Array<any>>(environment.API.concat('product')).subscribe(response => {

			response.filter(i => this.items.map(k => k.id).includes(i.id)).map(i => {

				const [amount] = this.items.filter(k => k.id === i.id);

				i.amount = amount;

				return i;

			});

		});

	}

	public sum() {
		return this.items.reduce((i, k) => {
			return (i.amount * i.price + ((i.amount * i.price) * (i.type.percentage / 100))) + (k.amount * k.price + ((k.amount * k.price) * (k.type.percentage / 100)));
		});
	}

	public save(): void {

		this.cartService.setCart(this.items);

	}

	public requestSave() {

		console.log(this.items);

	}

}
