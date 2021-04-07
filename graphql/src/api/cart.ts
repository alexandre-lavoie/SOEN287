import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, ResolverInterface, createUnionType } from 'type-graphql';
import ProductStack, { ProductStackCreate, ProductStackResolver, ProductStackUpdate, RESTProductStack } from './productstack';
import { DELETE, Endpoint, GET, IREST, POST, PUT } from './rest';

export interface RESTCart extends IREST {
    id: string
    itemstacks: RESTProductStack[]
}

@ObjectType()
export default class Cart {
    @Field(type => ID)
    public id: string;

    @Field(type => [ProductStack])
    public productstacks: ProductStack[];
}

@InputType()
export class CartCreate {
    @Field(type => [ProductStackCreate])
    public productstacks: ProductStackCreate[];
}

@InputType()
export class CartUpdate {
    @Field(type => ID)
    public id: string;

    @Field(type => [ProductStackUpdate], { nullable: true })
    public productstacks?: ProductStackUpdate[];
}

@Resolver(of => Cart)
export class CartResolver {
    public restToQL(data: RESTCart): Cart {
        return { 
            ...data, 
            productstacks: data.itemstacks ? Object.values(data.itemstacks).map((itemstack: any) => new ProductStackResolver().restToQL(itemstack)) : undefined
        }
    }

    public qlToREST(cart: Cart): RESTCart {
        return {
            ...cart,
            itemstacks: cart.productstacks ? Object.values(cart.productstacks).map((productstack: ProductStack) => new ProductStackResolver().qlToREST(productstack)) : undefined
        }
    }

    @Query(returns => Cart)
    async cart(@Arg("id") id: string): Promise<Cart> {
        const json = await GET(Endpoint.carts, { id });

        return this.restToQL(json.carts[id] as any);
    }

    @Query(returns => [Cart])
    async carts(): Promise<Cart[]> {
        const json = await GET(Endpoint.carts);

        return Object.values(json.carts).map((cart: any) => this.restToQL(cart));
    }

    @Mutation(returns => Cart)
    async createCart(@Arg("input") input: CartCreate): Promise<Cart> {
        input.productstacks = await Promise.all(input.productstacks.map(async (productstack, index) => await new ProductStackResolver().createProductStack(`${index + 1}`, productstack))) as any;

        return this.restToQL(await POST(Endpoint.carts, this.qlToREST(input as any)));
    }

    @Mutation(returns => Cart)
    async updateCart(@Arg("input") input?: CartUpdate): Promise<Cart> {
        if (input == null) return null;

        if(input.productstacks) {
            input.productstacks = await Promise.all(input.productstacks.map(async (productstack) => await new ProductStackResolver().updateProductStack(productstack))) as any;
        }

        return this.restToQL(await PUT(Endpoint.carts, this.qlToREST(input as any)));
    }

    @Mutation(returns => Cart)
    async deleteCart(@Arg("id") id: string): Promise<Cart> {
        return this.restToQL(await DELETE(Endpoint.carts, id));
    }
}