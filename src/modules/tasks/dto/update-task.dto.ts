import { PartialType } from '@nestjs/mapped-types';
import { CreateTaskDto } from './create-task.dto';

import { IsOptional } from 'class-validator';

// eslint-disable-next-line @typescript-eslint/no-unsafe-call
export class UpdateTaskDto extends PartialType(CreateTaskDto) {
  name: string;
  descripioin: string;
  @IsOptional()
  description?: string;

  completedAt?: Date;
}
