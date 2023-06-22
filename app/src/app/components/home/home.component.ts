import {Component} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";

@Component({
	selector: 'app-home',
	templateUrl: './home.component.html',
	styleUrls: ['./home.component.scss']
})
export class HomeComponent {

	public form!: FormGroup;
	public items$!: Observable<Array<any>>;

	public constructor(private http: HttpClient) {

	}

	public ngOnInit(): void {

		this.items$ = this.http.get<Array<any>>(environment.API.concat('product'));

	}
}
