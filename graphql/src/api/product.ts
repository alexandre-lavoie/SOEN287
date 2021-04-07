import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface, createUnionType } from 'type-graphql';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';
import Aisle, { AisleResolver } from './aisle';

export interface RESTProduct {
    id: string
    name: string
    description: string
    image: string
    price: string
}

@ObjectType()
export default class Product {
    @Field(type => ID)
    public id: string;

    @Field()
    public name: string;

    @Field()
    public description: string;

    @Field()
    public image: string;

    @Field()
    public price: string;

    @Field(type => [Aisle])
    public aisles: Aisle[];
}

@InputType()
export class ProductCreate {
    @Field()
    public name: string;

    @Field()
    public description: string;

    @Field()
    public image: string;

    @Field()
    public price: string;
}

@InputType()
export class ProductUpdate {
    @Field(type => ID)
    public id: string;

    @Field({ nullable: true })
    public name?: string;

    @Field({ nullable: true })
    public description?: string;

    @Field({ nullable: true })
    public image?: string;

    @Field({ nullable: true })
    public price?: string;
}

@Resolver(of => Product)
export class ProductResolver implements ResolverInterface<Product> {
    public restToQL(data: RESTProduct): Product {
        return data as any;
    }

    public qlToREST(product: Product): RESTProduct {
        return product;
    }

    @FieldResolver()
    async aisles(@Root() product: Product): Promise<Aisle[]> {
        const aisles = await new AisleResolver().aisles();

        return aisles.filter(aisle => aisle.productstacks.some(productstack => productstack.product.id == product.id));
    }

    @Query(returns => Product)
    async product(@Arg("id") id: string): Promise<Product> {
        const json = await GET(Endpoint.products, { id });

        return this.restToQL(json.items[id] as any);
    }

    @Query(returns => [Product])
    async products(): Promise<Product[]> {
        const json = await GET(Endpoint.products);

        return Object.values(json.items).map(item => this.restToQL(item as any));
    }

    @Mutation(returns => Product)
    async createProduct(@Arg("input") input: ProductCreate) {
        return this.restToQL(await POST(Endpoint.products, this.qlToREST(input as any)));
    }

    @Mutation(returns => Product)
    async updateProduct(@Arg("input") input?: ProductUpdate) {
        if (input == null) return null;

        return this.restToQL(await PUT(Endpoint.products, this.qlToREST(input as any)));
    }

    @Mutation(returns => Product)
    async deleteProduct(@Arg("id") id: string) {
        return this.restToQL(await DELETE(Endpoint.products, id));
    }
}