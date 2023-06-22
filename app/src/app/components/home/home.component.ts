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
	public cartList: Array<number> = [];

	public constructor(private http: HttpClient, private cartService: CartService) {

	}

	public ngOnInit(): void {

		this.cartList = this.cartService.lastValue;
		this.items$ = this.http.get<Array<any>>(environment.API.concat('product'));

	}

	public addCart(id: number): void {

		this.cartList.push(id);
		this.cartService.setCart(this.cartList);

	}
}
