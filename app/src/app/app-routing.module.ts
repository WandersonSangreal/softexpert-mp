import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {ProductsComponent} from "./components/products/products.component";
import {TypesComponent} from "./components/types/types.component";
import {TaxesComponent} from "./components/taxes/taxes.component";
import {CartComponent} from "./components/cart/cart.component";
import {HomeComponent} from "./components/home/home.component";

const routes: Routes = [
	{
		path: '',
		component: HomeComponent
	},
	{
		path: 'products',
		component: ProductsComponent
	},
	{
		path: 'types',
		component: TypesComponent
	},
	{
		path: 'taxes',
		component: TaxesComponent
	},
	{
		path: 'cart',
		component: CartComponent
	}
];

@NgModule({
	imports: [RouterModule.forRoot(routes)],
	exports: [RouterModule]
})
export class AppRoutingModule {
}
