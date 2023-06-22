import {Component, EventEmitter, Output} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";
import {CartService} from "../../services/cart.service";

@Component({
	selector: 'app-home',
	templateUrl: './home.component.html',
	styleUrls: ['./home.component.scss']
})
export class HomeComponent {

	public form!: FormGroup;
	public items$!: Observable<Array<any>>;
	public cartList: Array<any> = [];
	public cartListIDs: Array<number> = [];

	public constructor(private http: HttpClient, private cartService: CartService) {

	}

	public ngOnInit(): void {

		this.cartList = this.cartService.lastValue;
		this.cartListIDs = this.cartService.lastValue.map(i => i.id);
		this.items$ = this.http.get<Array<any>>(environment.API.concat('product'));

	}

	public addCart(item: any): void {

		item.amount = 1;

		this.cartList.push(item);
		this.cartListIDs.push(item.id);
		this.cartService.setCart(this.cartList);

	}
}
