import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface, createUnionType } from 'type-graphql';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';
import Aisle, { AisleResolver } from './aisle';

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
    @FieldResolver()
    async aisles(@Root() product: Product): Promise<Aisle[]> {
        const aisles = await new AisleResolver().aisles();

        return aisles.filter(aisle => aisle.productstacks.some(productstack => productstack.product.id == product.id));
    }

    @Query(returns => Product)
    async product(@Arg("id") id: string): Promise<Product> {
        const json = await GET(Endpoint.products, { id });

        return json.items[id] as any;
    }

    @Query(returns => [Product])
    async products(): Promise<Product[]> {
        const json = await GET(Endpoint.products);

        return Object.values(json.items) as any;
    }

    @Mutation(returns => Product)
    async createProduct(@Arg("input") input: ProductCreate) {
        return await POST(Endpoint.products, input);
    }

    @Mutation(returns => Product)
    async updateProduct(@Arg("input") input: ProductUpdate) {
        return await PUT(Endpoint.products, input);
    }

    @Mutation(returns => Product)
    async deleteProduct(@Arg("id") id: string) {
        const product = await this.product(id);

        if (product == undefined) return undefined;

        await DELETE(Endpoint.products, product.id);

        return product;
    }
}