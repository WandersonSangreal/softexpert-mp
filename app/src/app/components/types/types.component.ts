import { Component } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";

@Component({
  selector: 'app-types',
  templateUrl: './types.component.html',
  styleUrls: ['./types.component.scss']
})
export class TypesComponent {

	public form!: FormGroup;
	public items$!: Observable<Array<any>>;
	public taxes$!: Observable<Array<any>>;

	public constructor(private http: HttpClient, private formBuilder: FormBuilder) {

	}

	public ngOnInit(): void {

		this.items$ = this.http.get<Array<any>>(environment.API.concat('type'));
		this.taxes$ = this.http.get<Array<any>>(environment.API.concat('tax'));

		this.form = this.formBuilder.group({
			name: [null, [Validators.required]],
			tax_id: ['', [Validators.required]],
		});

	}

	public submit(): void {

		if (this.form.valid) {

			this.http.post<Array<any>>(environment.API.concat('type'), this.form.value).subscribe(response => {

				this.items$ = this.http.get<Array<any>>(environment.API.concat('type'));

				this.form.reset();

			});

		}

	}

}
