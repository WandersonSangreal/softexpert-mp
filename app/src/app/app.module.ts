import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {HeaderComponent} from './header/header.component';
import {ProductsComponent} from './components/products/products.component';
import {TypesComponent} from './components/types/types.component';
import {TaxesComponent} from './components/taxes/taxes.component';
import {CartComponent} from './components/cart/cart.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";
import {HomeComponent} from './components/home/home.component';
import {CartService} from "./services/cart.service";

@NgModule({
	declarations: [
		AppComponent,
		HeaderComponent,
		ProductsComponent,
		TypesComponent,
		TaxesComponent,
		CartComponent,
		HomeComponent
	],
	imports: [
		BrowserModule,
		AppRoutingModule,
		FormsModule,
		ReactiveFormsModule,
		HttpClientModule,
	],
	providers: [
		CartService
	],
	bootstrap: [AppComponent]
})
export class AppModule {
}
