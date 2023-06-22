import {Component} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../../environments/environment";

@Component({
	selector: 'app-taxes',
	templateUrl: './taxes.component.html',
	styleUrls: ['./taxes.component.scss']
})
export class TaxesComponent {

	public form!: FormGroup;
	public items$!: Observable<Array<any>>;

	public constructor(private http: HttpClient, private formBuilder: FormBuilder) {

	}

	public ngOnInit(): void {

		this.items$ = this.http.get<Array<any>>(environment.API.concat('tax'));

		this.form = this.formBuilder.group({
			percentage: [null, [Validators.required, Validators.pattern("^[0-9]+(\\.[0-9]{1,2})?$")]],
		});

	}

	public submit(): void {

		if (this.form.valid) {

			this.http.post<Array<any>>(environment.API.concat('tax'), this.form.value).subscribe(response => {

				this.items$ = this.http.get<Array<any>>(environment.API.concat('tax'));

				this.form.reset();

			});

		}

	}

}
