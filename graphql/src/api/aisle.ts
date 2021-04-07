import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, createUnionType } from 'type-graphql';
import ProductStack, { ProductStackCreate, ProductStackResolver, ProductStackUpdate, RESTProductStack } from './productstack';
import { DELETE, Endpoint, GET, IREST, POST, PUT } from './rest';

export interface RESTAisle extends IREST {
    id: string
    name: string
    description: string
    image: string
    itemstacks: RESTProductStack[]
}

@ObjectType()
export default class Aisle {
    @Field(type => ID)
    public id: string;

    @Field()
    public name: string;

    @Field()
    public description: string;

    @Field()
    public image: string;

    @Field(type => [ProductStack])
    public productstacks: ProductStack[];
}

@InputType()
export class AisleCreate {
    @Field()
    public name: string;

    @Field()
    public description: string;

    @Field()
    public image: string;

    @Field(type => [ProductStackCreate])
    public productstacks: ProductStackCreate[];
}

@InputType()
export class AisleUpdate {
    @Field(type => ID)
    public id: string;
    
    @Field({ nullable: true })
    public name?: string;

    @Field({ nullable: true })
    public description?: string;

    @Field({ nullable: true })
    public image?: string;

    @Field(type => [ProductStackUpdate], { nullable: true })
    public productstacks?: ProductStackUpdate[];
}

@Resolver(of => Aisle)
export class AisleResolver {
    public restToQL(data: RESTAisle): Aisle {
        return { 
            ...data, 
            productstacks: data.itemstacks ? Object.values(data.itemstacks).map((itemstack: any) => new ProductStackResolver().restToQL(itemstack)) : undefined
        }
    }

    public qlToREST(cart: Aisle): RESTAisle {
        return {
            ...cart,
            itemstacks: cart.productstacks ? Object.values(cart.productstacks).map((productstack: ProductStack) => new ProductStackResolver().qlToREST(productstack)) : undefined
        }
    }

    @Query(returns => Aisle)
    async aisle(@Arg("id") id: string): Promise<Aisle> {
        const json = await GET(Endpoint.aisles, { id });

        return this.restToQL(json.aisles[id] as any);
    }

    @Query(returns => [Aisle])
    async aisles(): Promise<Aisle[]> {
        const json = await GET(Endpoint.aisles);

        return Object.values(json.aisles).map((aisle: any) => this.restToQL(aisle));
    }

    @Mutation(returns => Aisle)
    async createAisle(@Arg("input") input: AisleCreate) {
        input.productstacks = await Promise.all(input.productstacks.map(async (productstack, index) => await new ProductStackResolver().createProductStack(`${index + 1}`, productstack))) as any;

        return this.restToQL(await POST(Endpoint.aisles, this.qlToREST(input as any)));
    }

    @Mutation(returns => Aisle)
    async updateAisle(@Arg("input") input?: AisleUpdate) {
        if (input == null) return null;

        if (input.productstacks) {
            input.productstacks = await Promise.all(input.productstacks.map(async (productstack) => await new ProductStackResolver().updateProductStack(productstack))) as any;
        }

        return this.restToQL(await PUT(Endpoint.aisles, this.qlToREST(input as any)));
    }

    @Mutation(returns => Aisle)
    async deleteAisle(@Arg("id") id: string) {
        return this.restToQL(await DELETE(Endpoint.aisles, id));
    }
}