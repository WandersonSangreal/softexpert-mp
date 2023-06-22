import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {environment} from "../../../environments/environment";

@Component({
	selector: 'app-products',
	templateUrl: './products.component.html',
	styleUrls: ['./products.component.scss']
})
export class ProductsComponent implements OnInit {

	public items$!: Observable<Array<any>>;

	public constructor(private http: HttpClient) {

	}

	public ngOnInit(): void {

		this.items$ = this.http.get<Array<any>>(environment.API.concat('product'));

	}

}
