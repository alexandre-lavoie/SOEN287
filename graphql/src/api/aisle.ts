import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, createUnionType } from 'type-graphql';
import ProductStack, { ProductStackCreate, ProductStackUpdate } from './productstack';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';

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
    @Query(returns => Aisle)
    async aisle(@Arg("id") id: string): Promise<Aisle> {
        const json = await GET(Endpoint.aisles, { id });
        const aisle = json.aisles[id] as any;

        aisle.productstacks = Object.values(aisle.itemstacks).map((itemstack: any) => ({ 
            ...itemstack, 
            product: { 
                id: itemstack.item 
            }
        }));

        return aisle;
    }

    @Query(returns => [Aisle])
    async aisles(): Promise<Aisle[]> {
        const json = await GET(Endpoint.aisles);

        return Object.values(json.aisles).map((aisle: any) => ({
            ...aisle,
            productstacks: Object.values(aisle.itemstacks).map((itemstack: any) => ({ 
                ...itemstack, 
                product: { 
                    id: itemstack.item 
                }
            }))
        }));
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Aisle)
    async createAisle(@Arg("input") input: AisleCreate) {
        return await POST(Endpoint.aisles, input);
    }

    /**
     * TODO: Implement.
     */
    @Mutation(returns => Aisle)
    async updateAisle(@Arg("input") input: AisleUpdate) {
        return await PUT(Endpoint.aisles, input);
    }

    @Mutation(returns => Aisle)
    async deleteAisle(@Arg("id") id: string) {
        const aisle = await this.aisle(id);

        if (aisle == undefined) return undefined;

        await DELETE(Endpoint.aisles, aisle.id);

        return aisle;
    }
}