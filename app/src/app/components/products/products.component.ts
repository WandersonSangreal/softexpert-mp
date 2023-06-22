import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {environment} from "../../../environments/environment";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
	selector: 'app-products',
	templateUrl: './products.component.html',
	styleUrls: ['./products.component.scss']
})
export class ProductsComponent implements OnInit {

	public form!: FormGroup;
	public types$!: Observable<Array<any>>;
	public items$!: Observable<Array<any>>;

	public constructor(private http: HttpClient, private formBuilder: FormBuilder) {

	}

	public ngOnInit(): void {

		this.types$ = this.http.get<Array<any>>(environment.API.concat('type'));
		this.items$ = this.http.get<Array<any>>(environment.API.concat('product'));

		this.form = this.formBuilder.group({
			name: [null, [Validators.required]],
			type_id: ['', [Validators.required]],
			price: [null, [Validators.required, Validators.pattern("^[0-9]+(\\.[0-9]{1,2})?$")]],
			description: [null, [Validators.required]],
		});

	}

	public submit(): void {

		if (this.form.valid) {

			this.http.post<Array<any>>(environment.API.concat('product'), this.form.value).subscribe(response => {

				this.items$ = this.http.get<Array<any>>(environment.API.concat('product'));

				this.form.reset();

			});

		}

	}

}
